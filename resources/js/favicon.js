function setFaviconByPath(path) {
    if (path.startsWith("/ma")) {
        changeFavicon(
            "/storage/images/logos/logo-ma-nurul-iman-sindangkerta-favicon.png"
        );
    } else if (path.startsWith("/mts")) {
        changeFavicon(
            "/storage/images/logos/logo-mts-nurul-iman-sindangkerta-favicon.png"
        );
    } else if (path.startsWith("/ponpes")) {
        changeFavicon(
            "/storage/images/logos/logo-ponpes-nurul-iman-sindangkerta-favicon.png"
        );
    } else if (path.startsWith("/ra")) {
        changeFavicon(
            "/storage/images/logos/logo-ra-nurul-iman-sindangkerta-favicon.png"
        );
    } else {
        changeFavicon(
            "/storage/images/logos/logo-yayasan-nurul-iman-sindangkerta-favicon.png"
        );
    }
}

function changeFavicon(iconUrl) {
    let link = document.querySelector("link[rel~='icon']");
    if (!link) {
        link = document.createElement("link");
        link.rel = "icon";
        document.head.appendChild(link);
    }
    link.href = iconUrl + "?v=" + Date.now(); // Hindari cache
}

export { changeFavicon, setFaviconByPath };
