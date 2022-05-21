function setDateTime() {
  const h3 = document.querySelector("h3");
  let d = new Date();
  h3.innerHTML = d;
}

setInterval(setDateTime, 1000);

const h5 = document.querySelector("h5");
const recentVisitedAt = localStorage.getItem("recentVisitedAt");
if (recentVisitedAt) {
  h5.innerHTML = `Your most recent visit to this page is ${recentVisitedAt}`;
  localStorage.setItem("recentVisitedAt", new Date());
} else {
  h5.innerHTML = "This is your first-time visit to this page";
  localStorage.setItem("recentVisitedAt", new Date());
}
