let darkMode = document.getElementById("dark");
let WhiteMode = document.getElementById("white");

darkMode.addEventListener("click", () => {
    alert("Hello ");
    document.body.classList.remove("white");
    document.body.classList.add("darkMode");
    darkMode.classList.add("dark");
    darkMode.classList.add("darkPath");
    WhiteMode.classList.add("remove");
    WhiteMode.classList.add("add");
});

WhiteMode.addEventListener("click", () => {
    alert("Hello ");
    document.body.classList.add("white");
    WhiteMode.classList.remove("add");
    WhiteMode.classList.remove("remove");
    darkMode.classList.remove("dark");
    darkMode.classList.remove("darkPath");
});
