const id = (e) => document.getElementById(e);
const add_event = (element, event, handle) => element.addEventListener(event, handle);

add_event(id("login"), "submit", async (e) => {
    e.preventDefault();

    await fetch("/api/login", {
        body: JSON.stringify({
            email : id("email").value,
            password : id("password").value,
        }),
        method: "post",
        headers: {
            "Content-Type" : "application/json"
        }
    })
        .then(r => r.json())
        .then(data => {
            localStorage.setItem("token", data["token"])
        })
})
