// indice
const singleContent = document.getElementById("single-content");
const sections = singleContent.querySelectorAll("div[id]"); // SOLO div con id dentro #single-content
const navLinks = document.querySelectorAll(".indice-list a");
const bar = document.querySelector(".indice-bar-fill");

const setActiveLink = () => {
  let currentId = "";
  let activeIndex = -1;
  let activeFound = false;

  sections.forEach((section) => {
    // Restituisce un oggetto con le coordinate dell'elemento rispetto alla finestra del browser
    const rect = section.getBoundingClientRect();
    // se la sezione dall' alto e compresa tra 0 e 100 e la sezione dal basso e compresa tra 100 o maggiore
    // attiva la il div corrispondente

    if (rect.top <= 100 && rect.bottom >= 100) {
      currentId = section.id;
      activeFound = true;
    }
  });

  // Per ogni link dell'indice, controlla se il suo href corrisponde all'ID attivo
  navLinks.forEach((link, index) => {
    const li = link.closest("li");
    const href = link.getAttribute("href");

    if (activeFound) {
      // Applica active solo se corrisponde alla sezione visibile
      if (href === `#${currentId}`) {
        li.classList.add("active");
        activeIndex = index;
      } else {
        li.classList.remove("active");
      }
    } else {
      // Nessuna sezione visibile → imposta il primo link come attivo
      if (index === 0) {
        li.classList.add("active");
        activeIndex = 0;
      } else {
        li.classList.remove("active");
      }
    }
  });
  // Aggiorna la barra di avanzamento
  if (bar && navLinks.length > 0) {
    const perc = ((activeIndex + 1) / navLinks.length) * 100;
    bar.style.width = `${perc}%`;
  }
};

// Ascolta lo scroll per attivare o rimuovere la classe active
document.addEventListener("scroll", setActiveLink, {
  // Esso serve ad informare al browser che il addEventListener non chiamerà event.preventDefault()
  passive: true,
  // Se non specifichi passive: true, il browser deve aspettare che il
  // listener venga eseguito per sapere se verrà chiamato preventDefault() → possibile rallentamento.
});
setActiveLink(); // Imposta inizialmente la classe active
