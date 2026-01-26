function sendMessage() {
    const username = document.getElementById("username").value;
    const message = document.getElementById("message").value;
  
    if (!username || !message) return;
  
    const chat = document.getElementById("chatMessages");
  
    const msgDiv = document.createElement("div");
    msgDiv.classList.add("message");
    msgDiv.innerHTML = `<strong>${username}:</strong> ${message}`;
  
    chat.appendChild(msgDiv);
    chat.scrollTop = chat.scrollHeight;
  
    document.getElementById("message").value = "";
  }
  