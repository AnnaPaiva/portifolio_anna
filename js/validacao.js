document
  .getElementById("contactForm")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    //Validação de campos obrigatórios
    var name = document.getElementById("name").value;
    var bDateValue = document.getElementById("bDate").value;
    var bDate = new Date(bDateValue);
    var email = document.getElementById("email").value;
    var telefone = document.getElementById("telefone").value;
    var message = document.getElementById("message").value;

    var today = new Date();
    var age = today.getFullYear() - bDate.getFullYear();
    var m = today.getMonth() - bDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < bDate.getDate())) {
      age--;
    }
    var foneRegex = /^\d{9}$/;
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (
      name === "" ||
      bDateValue === "" ||
      email === "" ||
      telefone === "" ||
      message === ""
    ) {
      alert("Por favor, preencha todos os campos!");
      return;
    } else if (age < 18) {
      alert("A idade deve ser maior ou igual a 18 anos.");
      return;
    } else if (!emailRegex.test(email)) {
      alert("Por favor, insira um email válido.");
      return;
    } else if (!foneRegex.test(telefone)) {
      alert("Por favor, insira um telefone valido com 9 dígitos.");
      return;
    }

    //Simulação de envio de dados
    alert(
      `Dados enviados com sucesso: ${name} ${bDateValue} ${email} ${telefone} ${message}`
    );
    document.getElementById("contactForm").reset();
  });
