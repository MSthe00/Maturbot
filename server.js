const Server = require("websocket").server;
const http = require("http");
const Message = require("./message.js");
const User = require("./user.js");

const PORT = 8000;
const MESSAGE_BUFFER_SIZE = 30;

let history = [];
const clients = [];

const server = http.createServer((req, res) => {});

server.listen(PORT, () => {
	log("Server started on port " + PORT);
});

const wsServer = new Server({
	httpServer: server
});

wsServer.on("request", (request) => {
	log(`Connection from origin ${request.origin}.`);
	const connection = request.accept(null, request.origin); 

	const user = addUser(connection);
	log("Connection accepted.");

	if (history.length > 0) {
		sendHistoryToUser(user, history);
	}
	
	connection.on("message", onMessage);

	connection.on("close", function(connection) {
		log(`User ${user.name} disconnected.`);
	
		deleteUser(user);
	});

	function onMessage(data) {
		if (data.type !== "utf8") { // Falsches Format der Daten wird abgelehnt
			return;
		}

		log(`${user.name}: ${data.utf8Data}`);

		const time = new Date().toLocaleTimeString();
		const message = new Message(user.name, user.color, data.utf8Data, time);
		const json = serializeMessage(message);
		addToHistory(message);
		
		sendToAllUsers(json);
	}
});

function addUser(connection) {
	const index = clients.length;
	const user = new User(index, connection)
	clients.push(user);
	return user;
}

function deleteUser(user) {
	if (!user) {
		log("No user specified.");
		return;
	}
	
	const index = clients.indexOf(user);
	log(index);
	if (index > -1) {
		clients.splice(index, 1);
	} else {
		log("Error: User could not be found:", user);
	}
}

function log(message) {
	console.log(`[${new Date().toLocaleTimeString()}] ${message}`)
}

function sendHistoryToUser(user, history) {
	user.connection.sendUTF(JSON.stringify({ type: "history", data: history }));
}

function sendToAllUsers(data) {
	for (let client of clients) {
		client.connection.sendUTF(data);
	}
}

function addToHistory(message) {
	history.push(message);
	history = history.slice(-MESSAGE_BUFFER_SIZE); // Chat hat Maximallänge
}

function serializeMessage(message) { // Serialisiert die JSON Nachricht
	const json = JSON.stringify({ 
		type: "message", 
		data: message
	});

	return json;
}
