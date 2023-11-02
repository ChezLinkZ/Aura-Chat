<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WebGL Simulation</title>
    <style>
        body { margin: 0; }
    </style>
</head>
<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/110/three.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cannon.js/0.6.2/cannon.min.js"></script>
    <script>
        // Set up scene, camera, and renderer
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer();
        renderer.setSize(window.innerWidth, window.innerHeight);
        document.body.appendChild(renderer.domElement);

        // Cannon.js physics setup
        const world = new CANNON.World();
        world.gravity.set(0, -9.82, 0); // Earth's gravity

        // Create a simple cube
        const geometry = new THREE.BoxGeometry();
        const material = new THREE.MeshBasicMaterial({ color: 0x00ff00 });
        const cube = new THREE.Mesh(geometry, material);
        scene.add(cube);

        // Create a Cannon.js rigid body for the cube
        const cubeShape = new CANNON.Box(new CANNON.Vec3(1, 1, 1)); // Box shape
        const cubeBody = new CANNON.Body({ mass: 1, shape: cubeShape });
        world.addBody(cubeBody);

        // Set initial parameters
        let gravity = -9.82; // Initial gravity value
        let positionY = 1; // Initial position on the Y-axis
        let color = 0x00ff00; // Initial color

        // Function to update cube properties
        function updateCube() {
            cube.material.color.setHex(color);
            cube.position.y = positionY;
        }

        // Handle user input for gravity
        const gravityInput = document.createElement("input");
        gravityInput.type = "range";
        gravityInput.min = -20;
        gravityInput.max = 20;
        gravityInput.step = 0.1;
        gravityInput.value = -9.82;
        gravityInput.addEventListener("input", (event) => {
            gravity = parseFloat(event.target.value);
            world.gravity.set(0, gravity, 0);
        });

        // Handle user input for position
        const positionInput = document.createElement("input");
        positionInput.type = "range";
        positionInput.min = 0.1;
        positionInput.max = 10;
        positionInput.step = 0.1;
        positionInput.value = 1;
        positionInput.addEventListener("input", (event) => {
            positionY = parseFloat(event.target.value);
            updateCube();
        });

        // Handle user input for color
        const colorInput = document.createElement("input");
        colorInput.type = "color";
        colorInput.value = "#00ff00";
        colorInput.addEventListener("input", (event) => {
            color = parseInt(event.target.value.replace("#", "0x"), 16);
            updateCube();
        });

        // Add input elements to adjust gravity, position, and color
        document.body.appendChild(gravityInput);
        document.body.appendChild(positionInput);
        document.body.appendChild(colorInput);

        // Set camera position and rotation
        camera.position.z = 5;
        camera.position.y = 1;
        camera.lookAt(0, 0, 0);

        // Animation loop
        function animate() {
            requestAnimationFrame(animate);

            // Step the Cannon.js physics simulation
            world.step(1 / 60);

            // Update cube position based on physics
            cube.position.copy(cubeBody.position);

            // Rotate the cube
            cube.rotation.x += 0.01;
            cube.rotation.y += 0.01;

            renderer.render(scene, camera);
        }

        animate();
    </script>
</body>
</html>
