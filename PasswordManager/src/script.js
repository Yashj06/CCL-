function setWidth() {
    if (window.innerWidth < 768) {
        document.getElementById("info-1").innerHTML = "Secured Storage Services.";
        document.getElementById("info-2").innerHTML = "Poweful Password Generator.";
        document.getElementById("info-3").innerHTML = "Free For All.";
    }
    else {
        document.getElementById("info-1").innerHTML = "Secure your account info and passwords using our secured storage services.";
        document.getElementById("info-2").innerHTML = "Generate customizable and strong passwords using our powerful password generator.";
        document.getElementById("info-3").innerHTML = "Yes! All our services are absolutely free for all. After all, your privacy is your right!";
    }
}