
// Function to format the date and time with Bangladesh timezone (GMT+6)
function formatDate(date) {
    const padZero = (num) => (num < 10 ? '0' + num : num);
    const year = date.getFullYear();
    const month = padZero(date.getMonth() + 1);
    const day = padZero(date.getDate());
    const hours = padZero(date.getHours());
    const minutes = padZero(date.getMinutes());
    return `${year}-${month}-${day}T${hours}:${minutes}`;
}

// Get the input field
const datetimeInput = document.getElementById("datetime");

// Set the initial value
datetimeInput.value = formatDate(new Date());

// Update the value every minute to show the current date and time in Bangladesh timezone
setInterval(() => {
    datetimeInput.value = formatDate(new Date());
}, 60000); // 60000 milliseconds = 1 minute
