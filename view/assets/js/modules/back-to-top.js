var btn = document.querySelector("#backTop");

btn.addEventListener("click", function () {
  scrollToTop(500); // Tempo de animação em milissegundos (por exemplo, 500ms)
});

function scrollToTop(duration) {
  var start = window.pageYOffset;
  var startTime = performance.now();

  function animation(currentTime) {
    var elapsedTime = currentTime - startTime;
    var scroll = easeInOutQuad(elapsedTime, start, -start, duration);

    window.scrollTo(0, scroll);

    if (elapsedTime < duration) {
      requestAnimationFrame(animation);
    }
  }

  // Função para criar uma curva suave de aceleração e desaceleração
  function easeInOutQuad(t, b, c, d) {
    t /= d / 2;
    if (t < 1) return (c / 2) * t * t + b;
    t--;
    return (-c / 2) * (t * (t - 2) - 1) + b;
  }

  requestAnimationFrame(animation);
}

/* === FAQ === */
var faqQuestions = document.querySelectorAll(".faq-question");

faqQuestions.forEach(function(question) {
    question.addEventListener('click', function() {
        this.classList.toggle('active');
        var answer = this.nextElementSibling;
        if (answer.style.display === 'block') {
            answer.style.display = 'none';
        } else {
            answer.style.display = 'block';
        }
    });
});