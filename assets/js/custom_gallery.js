let mediaFrame;

const galleriaContainer = document.getElementById("foto-galleria-container");
const galleriaSortable = document.getElementById("galleria-sortable");
const galleriaData = document.getElementById("foto-galleria-data");
const aggiungiBtn = document.getElementById("foto-aggiungi-img");

aggiungiBtn.addEventListener("click", (e) => {
  e.preventDefault();

  if (mediaFrame) {
    mediaFrame.open();
    return;
  }

  mediaFrame = wp.media({
    title: "Aggiungi immagini alla galleria",
    multiple: true,
    library: {
      type: "image",
    },
    button: {
      text: "Aggiungi immagini",
    },
  });

  mediaFrame.on("select", () => {
    const attachments = mediaFrame.state().get("selection");
    const idsCorrenti = Array.from(
      galleriaSortable.querySelectorAll(".sortable-item")
    ).map((el) => parseInt(el.dataset.id));

    const nuoviIds = attachments.map((a) => a.id);

    // Rimuove elementi non più selezionati
    idsCorrenti.forEach((id) => {
      if (!nuoviIds.includes(id)) {
        const el = galleriaSortable.querySelector(`[data-id="${id}"]`);
        if (el) el.remove();
      }
    });

    // Aggiunge nuove immagini
    attachments.each((attachment) => {
      const id = attachment.id;
      const thumb =
        attachment.attributes.sizes?.thumbnail?.url ||
        attachment.attributes.icon;
      const caption = attachment.attributes.caption || "";

      if (galleriaSortable.querySelector(`[data-id="${id}"]`)) return;

      const li = document.createElement("li");
      li.className = "sortable-item";
      li.dataset.id = id;

      li.innerHTML = `
                            <div class="img-wrapper">
                                <img src="${thumb}" />
                            </div>
                            <textarea class="img-caption" placeholder="Descrizione...">${caption}</textarea>
                            <button class="rimuovi-img button">Rimuovi</button>
                        `;

      galleriaSortable.appendChild(li);
    });

    aggiornaJson();
    evidenziaImmagineInEvidenza();
  });

  mediaFrame.on("open", () => {
    document.querySelector(".media-modal")?.classList.add("custom_modal_foto");

    const selection = mediaFrame.state().get("selection");

    galleriaSortable.querySelectorAll(".sortable-item").forEach((item) => {
      const id = parseInt(item.dataset.id);
      const attachment = wp.media.attachment(id);
      attachment.fetch();
      selection.add(attachment);
    });
  });

  mediaFrame.on("close", () => {
    document
      .querySelector(".media-modal")
      ?.classList.remove("custom_modal_foto");

    const attachments = mediaFrame.state().get("selection");
    const nuoviIds = attachments.map((a) => a.id);

    if (nuoviIds.length === 0) {
      galleriaSortable.innerHTML = "";
    }

    aggiornaJson();
    evidenziaImmagineInEvidenza();
  });

  mediaFrame.open();
});

// Rimuovi immagine
galleriaContainer.addEventListener("click", (e) => {
  if (e.target.classList.contains("rimuovi-img")) {
    e.target.closest("li").remove();
    aggiornaJson();
    evidenziaImmagineInEvidenza();
  }
});

// Aggiorna caption in tempo reale
galleriaContainer.addEventListener("input", (e) => {
  if (e.target.classList.contains("img-caption")) {
    aggiornaJson();
  }
});

// Inizializza sortable
Sortable.create(galleriaSortable, {
  animation: 150,
  onEnd: () => {
    aggiornaJson();
    evidenziaImmagineInEvidenza();
  },
});

function aggiornaJson() {
  const data = Array.from(
    galleriaSortable.querySelectorAll(".sortable-item")
  ).map((item) => ({
    id: parseInt(item.dataset.id),
    caption: item.querySelector(".img-caption")?.value || "",
  }));

  galleriaData.value = JSON.stringify(data);
  console.log("JSON aggiornato:", data);
}

function evidenziaImmagineInEvidenza() {
  galleriaSortable.querySelectorAll(".sortable-item").forEach((item) => {
    item.classList.remove("featured-img");
    item.querySelector(".featured-badge")?.remove();
  });

  const primo = galleriaSortable.querySelector(".sortable-item");
  if (primo) {
    primo.classList.add("featured-img");
    const wrapper = primo.querySelector(".img-wrapper");
    const badge = document.createElement("div");
    badge.className = "featured-badge";
    badge.textContent = "Immagine in evidenza";
    wrapper.prepend(badge);
  }
}

aggiornaJson();
evidenziaImmagineInEvidenza();
