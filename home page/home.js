function showWelcome(user) {
    document.getElementById("container").style.display = "none";
    document.getElementById("welcomeMessage").textContent = `Welcome, ${user.fullName}!`;
    document.getElementById("fullNameDisplay").textContent = user.fullName;
    document.getElementById("emailDisplay").textContent = user.email;
    document.getElementById("mobileDisplay").textContent = user.mobile;
}

// Load user data and display welcome if logged in
let users = JSON.parse(localStorage.getItem("users")) || [];
if (users.length > 0) {
    const loggedInUser = users[users.length - 1]; // Get the last registered user
    showWelcome(loggedInUser);
}
