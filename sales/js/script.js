let current = "0";

function appendNumber(num) {
  if (current === "0") {
    current = String(num);
  } else {
    current += String(num);
  }
  updateDisplay(current);
}

function appendDoubleZero() {
  if (current !== "0") {
    current += "00";
    updateDisplay(current);
  }
}

function clearDisplay() {
  current = "0";
  updateDisplay(current);
}

function add() {
  current += "+";
  updateDisplay(current);
}

function multiply() {
  current += "*";
  updateDisplay(current);
}

function tax() {
  current = Math.floor(parseInt(current) * 1.1).toString();
  updateDisplay(current);
}

function calculate() {
  try {
    current = eval(current).toString();
  } catch {
    current = "0";
  }
  updateDisplay(current);
}

function updateDisplay(value) {
  const display = document.getElementById("display");
  const num = parseInt(value.replace(/,/g, ""), 10);
  display.textContent = isNaN(num) ? "0" : num.toLocaleString();
}

function register() {
  const raw = document.getElementById("display").textContent.replace(/,/g, '');
  const amount = parseInt(raw, 10);
  if (isNaN(amount) || amount <= 0) {
    alert("正しい金額を入力してください。");
    return;
  }
  document.getElementById("registerAmount").value = amount;
  document.getElementById("registerForm").submit();
}
