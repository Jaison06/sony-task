const socket = new WebSocket("ws://localhost:8080");

const colors = {
  PRODUCING: "green",
  IDLE: "yellow",
  STARVED: "red",
};

const tableBody = document.querySelector("#machineTable tbody");
const statusMessage = document.getElementById("statusMessage");

// Keep track of existing rows
const machineRows = {};
let hasReceivedData = false;
// Initial state
statusMessage.innerText = "Loading machine data…";
statusMessage.style.display = "block";

// Handle incoming WebSocket data
socket.onmessage = function (event) {
  const data = JSON.parse(event.data);
  hasReceivedData = true;
  statusMessage.style.display = "none";

  let row;
  // Check if a row for this machine already exists
  if (machineRows[data.machine]) {
    row = machineRows[data.machine];
  } else {
    // Create a new row
    row = document.createElement("tr");

    const nameCell = document.createElement("td");
    nameCell.innerText = data.machine;

    const stateCell = document.createElement("td");
    stateCell.classList.add("status-cell");
    row.appendChild(nameCell);
    row.appendChild(stateCell);

    tableBody.appendChild(row);

    // Store reference for later updates
    machineRows[data.machine] = row;
  }

  // Update the state cell
  const stateCell = row.querySelector(".status-cell");
  stateCell.innerText = data.state;
  stateCell.style.backgroundColor = colors[data.state] || "gray";
};
