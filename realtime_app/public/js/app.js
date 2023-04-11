const socket = io.connect("http://localhost:3000");

document.addEventListener("click", (event) => {
    //console.log(event);
    if(event.target.tagName.toLowerCase() === "button" && event.target.getAttribute("data-id")){
        const itemId = event.target.getAttribute("data-id");
        
        socket.emit("order", {
            itemId : itemId
        });
    }
});

socket.on("order_success", (data) => {
    alert("Oder placed with code #" + data.order_code);
});