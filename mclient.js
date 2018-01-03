$(() => {
	const log = [];
	const input = $("#messages");

	const MESSAGES = {
		MOVED_FORWARD: "hat den Roboter forwÃ¤rts bewegt.",
		MOVED_BACKWARD: "hat den Roboter rÃ¼ckwÃ¤rts bewegt.",
		MOVED_LEFT: "hat den Roboter nach links bewegt.",
		MOVED_RIGHT: "hat den Roboter nach rechts bewegt.",
		OPENED_CLAW: "hat den Greifer geÃ¶ffnet.",
		CLOSED_CLAW: "hat den Greifer geschlossen."
	}

	window.WebSocket = window.WebSocket || window.MozWebSocket;

	if (!window.WebSocket) {
		console.error("Ihr Browser unterstützt Websocket nicht!");
		return;
	}

	const connection = new WebSocket("ws://maturbot.ddns.net:8000");
	connection.onerror = (error) => handleError(error);
	connection.onmessage = (res) => handleMessage(res);



	function send(message) {
		waitForConnection(() => {
			connection.send(message);
		}, 1000);
	}

	function waitForConnection(callback, interval) {
		if (connection.readyState === 1) {
			callback();
		} else {
			interval = interval || 1000;

			setTimeout(() => {
				waitForConnection(callback, interval);
			}, interval);
		}
	}

	function addMessage(author, color, message, time) {
		log.push(`[${time}] ${author}: ${message}`);

		const name = `<span style=\"font-weight:bold; color:${color}\">${author}:</span>`
		input.append(`<div class="message">[${time}] ${name} ${message}</div>`);
	}

	function handleError(error) {
		console.error("Verbindung fehlgeschlagen.");
	}

	function handleMessage(res) {
		let message;

		try {
			message = JSON.parse(res.data);
		} catch (e) {
			console.log("Invalides JSON: ", res.data);
			return;
		}

		const data = message.data;
		console.log("data:", data);

		if (message.type === "history") { // Anfrage für Gesamtverlauf
			for (let i = 0; i < data.length; i++) {
				addMessage(data[i].author, data[i].color, data[i].text, data[i].time);
				var element = document.getElementById("messages");
				element.scrollTop = element.scrollHeight;
			}
			
		} else if (message.type === "message") { // Anfrage für einzelne Nachricht
			addMessage(data.author, data.color, data.text, data.time);
			var element = document.getElementById("messages");
			element.scrollTop = element.scrollHeight;
		} else {
			console.error("Error parsing JSON:", json);
		}
	}
	
	$("#fwd").on('mousedown', function() {
    	function fw() {
	        $.ajax({
	        	  type: "POST",
	        	  url: "forward.php" 
	        	});    
	        send(MESSAGES.MOVED_FORWARD);
			wait = setTimeout(fw, 2000);
    	}
    	fw();
    });
    
    $("#fwd").on('mouseup mouseleave', function() {
    	clearTimeout(wait);
    });

 
	$("#bwd").on('mousedown', function() {
    	function bw() {
	        $.ajax({
	        	  type: "POST",
	        	  url: "backward.php" 
	        	});    
	        send(MESSAGES.MOVED_BACKWARD);
			wait = setTimeout(bw, 2000);
    	}
    	bw();
    });
    
    $("#bwd").on('mouseup mouseleave', function() {
    	clearTimeout(wait);
    });
    
    
	$("#rgt").on('mousedown', function() {
    	function rt() {
	        $.ajax({
	        	  type: "POST",
	        	  url: "right.php" 
	        	});    
	        send(MESSAGES.MOVED_RIGHT);
			wait = setTimeout(rt, 2000);
    	}
    	rt();
    });
    
    $("#rgt").on('mouseup mouseleave', function() {
    	clearTimeout(wait);
    });
    
    
	$("#lft").on('mousedown', function() {
    	function lt() {
	        $.ajax({
	        	  type: "POST",
	        	  url: "left.php" 
	        	});    
	        send(MESSAGES.MOVED_LEFT);
			wait = setTimeout(lt, 2000);
    	}
    	lt();
    });
    
    $("#lft").on('mouseup mouseleave', function() {
    	clearTimeout(wait);
    });
    
    
	$("#opn").on('mousedown', function() {
    	function op() {
	        $.ajax({
	        	  type: "POST",
	        	  url: "open.php" 
	        	});    
	        send(MESSAGES.OPENED_CLAW);
			wait = setTimeout(op, 2000);
    	}
    	op();
    });
    
    $("#opn").on('mouseup mouseleave', function() {
    	clearTimeout(wait);
    });
    
    
	$("#cls").on('mousedown', function() {
    	function cl() {
	        $.ajax({
	        	  type: "POST",
	        	  url: "close.php" 
	        	});    
	        send(MESSAGES.CLOSED_CLAW);
			wait = setTimeout(cl, 2000);
    	}
    	cl();
    });
    
    $("#cls").on('mouseup mouseleave', function() {
    	clearTimeout(wait);
    });
});