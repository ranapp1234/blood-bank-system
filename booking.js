
const inputElement = document.getElementById("datetime-input");
const selectedDateTime = inputElement.valueAsDate;
const hours = selectedDateTime.getHours();
const minutes = selectedDateTime.getMinutes();
const formattedTime = `${hours % 12 || 12}:${minutes} ${
  hours >= 12 ? "PM" : "AM"
}`;
console.log(formattedTime);
