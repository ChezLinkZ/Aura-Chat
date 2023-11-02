const messagesContainer = document.getElementById("messages");
const inputBox = document.querySelector('input[name="message"]');
const messageForm = document.getElementById("message-form");
const onlineUsersList = document.getElementById("online-users");
const USER_COLORS = {
  ChezLinkZ: "#edcf28",
  Bhop: "#33eeff",
  Console: "#0ed100",
  "☭☭☭☭☭": "#FF0000",
  Aura: "#FFFE00",
};

var userProfileData = null;

fetch("profile/" + username + "/profile.json").then(response => response.json()).then(response => {
    userProfileData = response;
  });

var previousChatLength = 0; // Variable to store previous chat length
scrollToBottom();

function escapeHtml(text) {
  return text.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
}

function userTags(text) {
  const tagPattern = /(@\S+)/g;


  return text.replace(tagPattern, '<span class="user-tag">$1</span>');

}

function boldifyText(text) {
  return text.replace(/\*\*(.*?)\*\*/g, "<b>$1</b>").replace(/\*(.*?)\*/g, "<i>$1</i>").replace(/__(.*?)__/g, "<u>$1</u>");
}
let usersData; // Declare the variable in a broader scope
async function fetchData() {
  try {
    const response = await fetch("data/users.json"); // Adjust the path as needed
    if (!response.ok) {
      throw new Error("Network response was not ok");
    }
    usersData = await response.json(); // Set the variable
  } catch (error) {
    console.error("Error fetching data:", error);
  }
}
async function initialize() {
  await fetchData();
  if (usersData !== undefined) {

  } else {
    console.error("Data was not fetched successfully.");
  }
}
initialize();
var prevUser = "";
var prevMessages = null;

function fetchAndDisplayMessages(update, scrollDown) {
  fetch("data/chat.json").then((response) => response.json()).then((messages) => {
    if (!isEqual(messages, prevMessages)) {
      renderMessages(messages, update);
      prevMessages = messages;
    }
  }).catch((error) => {
    console.error("Error fetching chat data:", error);
  });
}

function isEqual(arr1, arr2) {
  return JSON.stringify(arr1) === JSON.stringify(arr2);
}
var userStreak = 0;

function renderMessages(messages, override, scrollDown) {
  if (messages === prevMessages && !override) {
    return;
  }
  let scrollTop = $("#messages").scrollTop();

  messagesContainer.innerHTML = "";

  prevUser = "";
  userStreak = 0;
  let index = 0;
  messages.forEach((message) => {
    const pfpImage = document.createElement("img");
    pfpImage.classList.add("pfp");
    try {
      pfpImage.src = "profile/" + message.username + "/pfp.png";
    } catch (TypeError) {
      pfpImage.src = "assets/images/pfp.png";
    }
    pfpImage.alt = "Profile Picture";
    const nameElement = document.createElement("span");
    nameElement.classList.add("name");
    nameElement.innerHTML = message.username;
    if (USER_COLORS[message.username]) {
      nameElement.style.color = USER_COLORS[message.username];
    }
    const messageText = message.message;

    const line = messageText;
    const line_number = 0;
    const messageElement = document.createElement("div");
    messageElement.classList.add("message");
    const messageContent = document.createElement("div");
    messageContent.classList.add("message-content");


    const anchorRegex = /((http|https):\/\/[^\s]+)/g;
    const lineHTML = boldifyText(userTags(line.replace(anchorRegex, '<a href="$1" target="_blank">$1</a>'), ), );
    messageContent.innerHTML = lineHTML;
    let newUser = prevUser != (message.username || userStreak % 5 == 0);
    if (newUser) {
      messageElement.appendChild(pfpImage.cloneNode(true));
      messageElement.style.marginTop = "50px";
      //messageElement.style.marginLeft = "52px";

    }
    messageElement.appendChild(messageContent);
    const timestampElement = document.createElement("div");
    timestampElement.classList.add("timestamp");
    const currentTime = message.time;
    timestampElement.textContent = currentTime;
    if (newUser) {
      messageElement.appendChild(nameElement.cloneNode(true));
      //messageElement.appendChild(timestampElement);
      userStreak = 0;
    } else {
      userStreak++;
    }
    const deleteElement = document.createElement("div");
    deleteElement.classList.add("delete-message");
    deleteElement.setAttribute("onclick", "deleteMessage(" + (index).toString() + ");");
    deleteElement.innerHTML = `<img src="assets/images/delete.png" />`
    deleteElement.setAttribute("style", "display: none !important");
    if (usersData[username]["premium"]) {
      messageElement.appendChild(deleteElement)
    }
    if (messageElement.textContent.includes("@" + username.toString()) || messageElement.textContent.includes("@everyone")) {
      messageElement.classList.add("ping-message");

      let pingBar = document.createElement("div");
      pingBar.classList.add("ping-bar");
      messageElement.appendChild(pingBar);

      if (USER_COLORS[message.username]) {
        messageElement.setAttribute("style", "color: " + USER_COLORS[message.username] + " !important");
      }
    }


    messagesContainer.appendChild(messageElement);
    prevUser = message.username;
    index++;
  });
  const currentChatLength = messages.length;



  if (Math.abs(messagesContainer.scrollHeight - messagesContainer.clientHeight - messagesContainer.scrollTop, ) < 300 || scrollDown) {
    $("#messages").scrollTop($("#messages")[0].scrollHeight);
  }
  prevMessages = messages;
}

function sendMessage(message, reply) {
  if (message[0] == "/") {
    inputBox.value = "";
    handleCommand(message);
    return 0;
  }
  fetch("backend/send_message.php", {
    method: "POST",
    body: new URLSearchParams({
      username: username,
      message: message,
      time: new Date().toLocaleTimeString().toString(),
      reply: reply,
    }),
  })
  /*.then((response) => response.json()).then((data) => {
    if (data.success) {
      fetchAndDisplayMessages(true); // Fetch and display updated messages
      inputBox.value = ""; // Clear the input box
      scrollToBottom(); // Scroll to the bottom after sending a message
    }
  });
 */
  inputBox.value = "";
}

function scrollToBottom() {
  $(".chat-container").scrollTop = 100;
}
messageForm.addEventListener("submit", function(e) {
  e.preventDefault();
  const message = inputBox.value.trim();
  if (message !== "") {
    sendMessage(message.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;"), );
  }
});
document.getElementById("image-upload").addEventListener("change", function() {
  const input = document.getElementById("image-upload");
  const file = input.files[0];
  if (file) {
    if (file.type.startsWith("image/")) {
      const formData = new FormData();
      formData.append("image", file);
      fetch("backend/upload.php", {
        method: "POST",
        body: formData,
      }).then((response) => response.json()).then((data) => {

        sendMessage("<img src='data/uploads/" + data.fileName + "' />");
      }).catch((error) => {
        console.error("Error uploading image:", error);
      });
    } else {
      const formData = new FormData();
      formData.append("image", file);
      fetch("backend/upload.php", {
        method: "POST",
        body: formData,
      }).then((response) => response.json()).then((data) => {
        if (data.success) {
          const fileName = data.fileName;
          const downloadLink = document.createElement("a");
          downloadLink.href = `data/uploads/${fileName}`;
          downloadLink.download = fileName.split("\\")[2];
          downloadLink.textContent = fileName;
          const messageText = document.createElement("div");
          const downloadIcon = document.createElement("img");
          downloadIcon.classList.add("download-icon");
          downloadIcon.src = "assets/images/download.png";
          messageText.appendChild(downloadIcon);
          messageText.appendChild(downloadLink);
          sendMessage(messageText.innerHTML);
        } else {
          console.error("Error uploading file:", data.error);
        }
      }).catch((error) => {
        console.error("Error uploading file:", error);
      });
    }
  } else {
    alert("Please select a file to upload.");
  }
});

function deleteMessage(messageId) {
  fetch("backend/delete_message.php", {
    method: "POST",
    body: new URLSearchParams({
      messageId: messageId,
    }),
  }).then((response) => response).then((data) => {
    if (data.success) {
      fetchAndDisplayMessages(); // Fetch and display updated messages
      scrollToBottom(); // Scroll to the bottom after deleting a message
    }
  });
}
document.querySelector(".delete-message a").addEventListener("click", function(event) {
  event.preventDefault();
  const messageId = document.querySelector(".context-menu").getAttribute("data-message-id");
  deleteMessage(messageId);
  hideMenu(); // Hide the context menu
});

function checkShiftDelete() {}

function main() {
  fetchAndDisplayMessages(true, true);
}
fetchAndDisplayMessages(true, true);
setTimeout(function() {
  $("#messages").scrollTop($("#messages")[0].scrollHeight)
}, 200);
setInterval(main, 500);

function loadTheme(themeNumber, callback) {
  fetch("data/themes.json").then((response) => {
    if (!response.ok) {
      throw new Error(`Failed to fetch themes: ${response.status} ${response.statusText}`, );
    }
    return response.json();
  }).then((themes) => {
    const selectedTheme = themes[themeNumber];
    if (selectedTheme) {
      const root = document.documentElement;
      for (const variable in selectedTheme) {
        if (selectedTheme.hasOwnProperty(variable)) {
          root.style.setProperty(variable, selectedTheme[variable]);
        }
      }
      if (typeof callback === "function") {
        callback();
      }
    }
  }).catch((error) => {
    console.error("Error loading theme:", error);
  });
}
fetch("profile/" + username + "/profile.json").then((response) => response.json().theme).then((theme) => {
  loadTheme(theme);
});

function fetchUsersJsonAndLoadTheme(username) {
  const jsonFileURL = "data/users.json"; // Replace with the actual URL
  fetch(jsonFileURL).then((response) => {
    if (!response.ok) {
      throw new Error("Network response was not ok");
    }
    return response.json();
  }).then((data) => {
    if (data.hasOwnProperty(username)) {
      loadUsers(data);
    } else {
      console.error(`User ${username} not found in users.json`);
    }
  }).catch((error) => {
    console.error("Error:", error);
  });
}

function loadUsers(userData) {
  let usersList = document.getElementById("users-list");
  Object.keys(userData).forEach((user) => {
    if (user != "Aura" && user != "Console") {
      let userTextBody = document.createElement("div");
      let userTextPfp = document.createElement("img");
      let userText = document.createElement("span");
      userTextPfp.src = "profile/" + user.toString() + "/pfp.png";
      userText.textContent = user.toString();
      userTextBody.append(userTextPfp);
      userTextBody.append(userText);
      userTextBody.setAttribute("onclick", "displayProfile(\"" + user.toString() + "\")");
      usersList.append(userTextBody);
      usersList.append(document.createElement("br"));
    }
  });
}
var holdingShift = false;

function logKeyDown(e) {
  if (e.code == "ShiftLeft") {
    holdingShift = true;
    let deleteMessage = document.getElementsByClassName("delete-message");
    for (let i = 0; i < deleteMessage.length; i++) {
      deleteMessage[i].setAttribute("style", "");
    }
  }
}

function logKeyUp(e) {
  if (e.code == "ShiftLeft") {
    holdingShift = false;
    let deleteMessage = document.getElementsByClassName("delete-message");
    for (let i = 0; i < deleteMessage.length; i++) {
      deleteMessage[i].setAttribute("style", "display: none !important");
    }
  }
}
document.addEventListener("DOMContentLoaded", function() {
  /*
if (!usersData[username]["premium"]) {
    document.getElementById("clearButton").style.display = "none";

}*/
  document.getElementById("sidebar-bottom-pfp").setAttribute("src", "profile/" + username + "/pfp.png");
  document.getElementById("sidebar-bottom-username").textContent = username;
  document.addEventListener("keydown", logKeyDown);
  document.addEventListener("keyup", logKeyUp);
  fetchUsersJsonAndLoadTheme(username);
});

function clearChat() {
  const chatFilePath = "data/chat.json";
  fetch("backend/clear_chat.php", {
    method: "POST",
    body: JSON.stringify({}),
    headers: {
      "Content-Type": "application/json",
    },
  }).then((response) => {
    if (response.ok) {
      updateMessages();
    } else {
      console.error("Failed to clear chat.");
    }
  }).catch((error) => {
    console.error("Error:", error);
  });
}

document.onclick = hideMenu;
document.oncontextmenu = rightClick;

function hideMenu() {
  document.getElementById("contextMenu").style.display = "none";
}

function rightClick(e) {
  e.preventDefault();
  if (document.getElementById("contextMenu").style.display == "block") {
    hideMenu();
  } else {
    var menu = document.getElementById("contextMenu");
    menu.style.display = "block";
    menu.style.left = e.pageX + "px";
    menu.style.top = e.pageY + "px";
  }
}
/*command code:

else if (tokens[0] == "") {
    if (tokens.length > 1) {
      //do stuff
    } else {
      message = "❌ Missing argument at " + tokens[0]
    }

    */
function handleCommand(command) {
  let tokens = command.toString().substring(1).split(" ");
  let message = "❌ Error running command!";
  let user = "Aura";
  if (tokens[0] == "say") {
    if (tokens.length > 1) {
      message = command.split("/say ")[1];
    } else {
      message = "❌ Missing argument at /say <- here";
    }
  } else if (tokens[0] == "help") {
    if (tokens.length > 1) {
      message = "DEBUG: this is help command used on a specific command: /" + tokens[1];
    } else {
      message = "<b>/ </b>Commands:<br>/help - Display this message.<br>/say [text] - Make me say whatever you want.<br>/clear [confirm] - Clear the entire chat.<br>/backup [save / load] - Save or load the chat contents backup.";
    }
  } else if (tokens[0] == "backup") {
    if (tokens.length > 1) {
      if (tokens[1] == "save") {
        message = "Chat Backup Saved!";
        fetch("backend/chat_backup_save.php");
      } else if (tokens[1] == "load") {
        message = "Chat Backup Loaded!";
        fetch("backend/chat_backup_load.php");
      } else {
        message = "❌ Invalid argument at /backup<u> " + tokens[1] + " </u><- here. Options: [save / load]";
      }
    } else {
      message = "❌ Missing argument at /backup <- here";
    }
  } else if (tokens[0] == "clear") {
    if (tokens.length == 2) {
      if (tokens[1] == "confirm") {
      clearChat();
        message = "✅ Chat Cleared Successfully!"
      }
    }else {
    message = "❌ Please enter \"/clear confirm\" to confirm clearing the chat.";
    }
    
  } else {
    message = "❌ Command /" + tokens[0] + " not found. Use /help for a list of commands.";
  }
  fetch("backend/send_message.php", {
    method: "POST",
    body: new URLSearchParams({
      username: user,
      message: message,
      time: new Date().toLocaleTimeString().toString(),
    }),
  }).then((response) => response.json()).then((data) => {
    if (data.success) {
      fetchAndDisplayMessages(true); // Fetch and display updated messages
      inputBox.value = ""; // Clear the input box
      scrollToBottom(); // Scroll to the bottom after sending a message
    }
  });
}
var profileShowing = false;

function displayProfile(profile) {
  let profileElement = document.getElementById("profile");
  let bannerElement = document.getElementById("banner");
  let pfpElement = document.getElementById("profile-pfp");
  let nameElement = document.getElementById("profile-name");
  let statusElement = document.getElementById("profile-status");
  let bioElement = document.getElementById("profile-bio");
  pfpElement.setAttribute("src", ("profile/" + profile + "/pfp.png"));
  nameElement.textContent = profile;
  let profileData = null;
  fetch("profile/" + profile + "/profile.json").then(response => response.json()).then(response => {
    profileData = response;
    statusElement.textContent = profileData.status.toString().slice(0, Math.min(profileData.status.length, 45)).toString();
    if (profileData.status.toString().length >= 45) {
      statusElement.textContent += "...";
    }
    bioElement.textContent = profileData.bio.toString();
    bannerElement.style = "background-color: " + profileData.banner + ";";
    
    return;
  });
  if (profileShowing) {
    profileElement.setAttribute("style", "display: block !important");
  } else {
    profileElement.setAttribute("style", "");
  }
  profileShowing = !profileShowing;
}

function tabCloak(cloak) {

  const cloaks = [
    ["Chat - Aura", "assets/cloaks/favicon.ico"],
    ["Classes", "assets/cloaks/classroom.ico"]
  ]


  var l = document.querySelector("link[rel*='icon']") || document.createElement('link');
  l.type = 'image/x-icon';
  l.rel = 'shortcut icon';
  l.href = cloaks[cloak][1];
  document.getElementsByTagName('head')[0].appendChild(l);
  document.title = cloaks[cloak][0];
}

document.getElementsByClassName("chat-container")[0].addEventListener("click", function() {
  document.getElementById("profile").setAttribute("style", "");
});