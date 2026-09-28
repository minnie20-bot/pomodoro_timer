<!DOCTYPE html>
<html>
<head>
    <title>Pomodoro Timer</title>

    <style>
        body {
            font-family: cursive;
            background: #B48ABC; /* default work */
            color: white;
            text-align: center;
            padding-top: 40px;
            transition: 0.5s;
        }

        .container {
            max-width: 500px;
            margin: auto;
            padding: 20px;
        }

        .timer {
            font-size: 60px;
            margin: 20px;
            font-weight: bold;
        }

        button {
            padding: 10px 20px;
            margin: 5px;
            border: none;
            cursor: pointer;
            border-radius: 8px;
            font-weight: bold;
        }

        .start { background: #222; color: white; }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            background: rgba(0,0,0,0.3);
            margin: 5px auto;
            padding: 10px;
            width: 300px;
            border-radius: 8px;
        }

        input {
            padding: 10px;
            border-radius: 8px;
            border: none;
            width: 200px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Pomodoro Timer</h1>

    <button onclick="setMode('work')">Work</button>
    <button onclick="setMode('short')">Short Break</button>
    <button onclick="setMode('long')">Long Break</button>

    <h3 id="message">Time to focus!</h3>

    <div class="timer" id="timer">25:00</div>

    <button class="start" onclick="startTimer()">Start</button>

    <hr>

    <h2>Add Tasks</h2>

    <input type="text" id="taskInput" placeholder="Add task...">
    <button onclick="addTask()">Add</button>

    <ul id="taskList"></ul>

</div>

<script>

let modes = {
    work: 1500,
    short: 300,
    long: 900
};

let colors = {
    work: "#B48ABC",
    short: "#CFC877",
    long: "#82AFC4"
};

let messages = {
    work: "Time to focus!",
    short: "Time for a break!",
    long: "Long break mode"
};

let currentMode = "work";
let time = modes[currentMode];
let timer = null;

// TASKS
let tasks = [];

function addTask() {
    let input = document.getElementById("taskInput");
    if (input.value.trim() === "") return;

    tasks.push(input.value);
    input.value = "";
    renderTasks();
}

function renderTasks() {
    let list = document.getElementById("taskList");
    list.innerHTML = "";

    tasks.forEach(task => {
        list.innerHTML += `<li>${task}</li>`;
    });
}

// TIMER DISPLAY
function update() {
    let m = Math.floor(time / 60);
    let s = time % 60;
    document.getElementById("timer").innerText =
        `${m}:${s < 10 ? "0" : ""}${s}`;
}

// MODE SWITCH + COLOR CHANGE
function setMode(mode) {
    currentMode = mode;
    time = modes[mode];

    document.body.style.background = colors[mode];
    document.getElementById("message").innerText = messages[mode];

    update();
}

// START TIMER
function startTimer() {
    if (timer) return;

    timer = setInterval(() => {
        time--;
        update();

        if (time <= 0) {
            clearInterval(timer);
            timer = null;

            if (currentMode === "work") {
                alert("Work done! Take a break ☕");
                setMode("short");
            } 
            else if (currentMode === "short") {
                alert("Break done! Back to focus 💪");
                setMode("work");
            }
            else {
                alert("Long break done!");
                setMode("work");
            }

            startTimer();
        }
    }, 1000);
}

// INIT
document.addEventListener("DOMContentLoaded", () => {
    setMode("work");
    renderTasks();
});

</script>

</body>
</html>