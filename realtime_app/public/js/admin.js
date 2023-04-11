const socket = io.connect("http://localhost:3000");

socket.on("order_processing", (data) => {
    //alert("Placed order with code #" + data.order.order_code);
    let container = document.getElementById("container");
    container.innerHTML += "<div class='row p-4 my-4 border border-primary'>Placed order with code #" + data.order.order_code + "</div>";
});