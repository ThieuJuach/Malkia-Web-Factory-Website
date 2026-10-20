// Malkia Web Factory — contact form AJAX submit with graceful no-JS fallback
(function () {
  const form = document.getElementById("contactForm");
  if (!form) return;

  const alertBox = document.getElementById("formAlert");
  const submitBtn = document.getElementById("submitBtn");

  function showAlert(ok, message) {
    alertBox.innerHTML =
      '<div class="alert ' +
      (ok ? "alert-success" : "alert-danger") +
      ' rounded-3" role="alert">' +
      message +
      "</div>";
  }

  form.addEventListener("submit", async function (e) {
    e.preventDefault();
    alertBox.innerHTML = "";

    if (!form.checkValidity()) {
      form.classList.add("was-validated");
      return;
    }

    const original = submitBtn.textContent;
    submitBtn.disabled = true;
    submitBtn.textContent = "Sending…";

    try {
      const res = await fetch(form.action, {
        method: "POST",
        body: new FormData(form),
        headers: { "X-Requested-With": "XMLHttpRequest", Accept: "application/json" },
      });
      const data = await res.json();
      showAlert(data.success, data.message);
      if (data.success) {
        form.reset();
        form.classList.remove("was-validated");
      }
    } catch (err) {
      showAlert(
        false,
        "We couldn't send your message right now. Please email us at hello@malkiafactory.com."
      );
    } finally {
      submitBtn.disabled = false;
      submitBtn.textContent = original;
    }
  });
})();
