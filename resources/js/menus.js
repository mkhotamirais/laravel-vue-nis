export const mainMenus = [
    { title: "PPDB", url: "/ppdb" },
    { title: "Home", url: "/" },
    {
        title: "Profil",
        url: "#",
        subMenus: [
            { title: "Ponpes", url: "/profile-ponpes" },
            { title: "RA", url: "/profile-ra" },
            { title: "MTs", url: "/profile-mts" },
            { title: "MA", url: "/profile-ma" },
        ],
    },
    { title: "Informasi", url: "/informasi" },
    { title: "Ekstrakurikuler", url: "/ekstrakurikuler" },
    { title: "Fasilitas", name: "fasilitas", url: "/fasilitas" },
    { title: "Kontak", name: "kontak", url: "/kontak" },
];

export const userMenus = [
    { title: "Profil", url: "/profile", icon: "user" },
    { title: "Dashboard", url: "/dashboard", icon: "gauge" },
    { title: "Informasi", url: "/informasi", icon: "sitemap" },
    {
        title: "Information Category",
        url: "/information-category",
        icon: "sitemap",
    },
    { title: "Facility", url: "/fasilitas", icon: "images" },
    { title: "Facility Category", url: "/facility-category", icon: "images" },
    { title: "Quotes", url: "/quote", icon: "quote-left" },
    { title: "Ekstrakurikuler", url: "/ekstrakurikuler", icon: "futbol" },
    { title: "Pengumuman & Agenda", url: "/agenda", icon: "calendar-days" },
];

export const logos = [
    {
        src: "/storage/images/logos/logo-yayasan-nurul-iman-sindangkerta.png",
        alt: "Logo Yayasan Nurul Iman Sindangkerta",
    },
    {
        src: "/storage/images/logos/logo-ponpes-nurul-iman-sindangkerta.png",
        alt: "Logo Ponpes Nurul Iman Sindangkerta",
    },
    {
        src: "/storage/images/logos/logo-ma-nurul-iman-sindangkerta.png",
        alt: "Logo Ma Nurul Iman Sindangkerta",
    },
];

export const branchs = [
    {
        title: "RA",
        url: "/profile-ra",
        total: "25+",
        logo: "/storage/images/logos/logo-ra-nurul-iman-sindangkerta.png",
        altLogo: "Logo ra nurul iman sindangkerta",
    },
    {
        title: "Ponpes",
        url: "/profile-ponpes",
        total: "210+",
        logo: "/storage/images/logos/logo-ponpes-nurul-iman-sindangkerta.png",
        altLogo: "Logo ponpes nurul iman sindangkerta",
    },
    {
        title: "MA",
        url: "/profile-ma",
        total: "290+",
        logo: "/storage/images/logos/logo-ma-nurul-iman-sindangkerta.png",
        altLogo: "Logo ma nurul iman sindangkerta",
    },
    {
        title: "MTs",
        url: "/profile-mts",
        total: "140+",
        logo: "/storage/images/logos/logo-mts-nurul-iman-sindangkerta.png",
        altLogo: "Logo mts nurul iman sindangkerta",
    },
];

export const footerMenus1 = [
    { title: "PPDB", url: "/ppdb" },
    { title: "Informasi", url: "/informasi" },
    { title: "Fasilitas", url: "/fasilitas" },
    { title: "Quotes", url: "/quote" },
    { title: "Agenda & Pengumuman", url: "/agenda" },
];

export const footerMenus2 = [
    { title: "Masuk", url: "/login" },
    { title: "Profile Ponpes", url: "/ponpes/profile" },
    { title: "Profile RA", url: "/ra/profile" },
    { title: "Profile MTs", url: "/mts/profile" },
    {
        title: "Profile MA",
        url: "https://appmadrasah.kemenag.go.id/web/profile?nsm=131232170036",
    },
];

export const contactMenus = [
    {
        title: "Ponpes",
        subMenus: [
            {
                title: "contact.ponpes@nuruliman-sindangkerta.sch.id",
                icon: "fa-regular fa-envelope",
                url: "https://mailto:contact.ponpes@nuruliman-sindangkerta.sch.id",
            },
        ],
    },
    {
        title: "RA",
        subMenus: [
            {
                title: "contact.ra@nuruliman-sindangkerta.sch.id",
                icon: "fa-regular fa-envelope",
                url: "https://mailto:contact.ra@nuruliman-sindangkerta.sch.id",
            },
        ],
    },
    {
        title: "MTs",
        subMenus: [
            {
                title: "contact.mts@nuruliman-sindangkerta.sch.id",
                icon: "fa-regular fa-envelope",
                url: "https://mailto:contact.mts@nuruliman-sindangkerta.sch.id",
            },
        ],
    },
    {
        title: "MA",
        subMenus: [
            {
                title: "087821395680",
                icon: "fa-brands fa-whatsapp",
                url: "https://wa.me/6287821395680",
            },
            {
                title: "081809299580",
                icon: "fa-brands fa-whatsapp",
                url: "https://wa.me/6281809299580",
            },
            {
                title: "contact.ma@nuruliman-sindangkerta.sch.id",
                icon: "fa-regular fa-envelope",
                url: "https://mailto:contact.mts@nuruliman-sindangkerta.sch.id",
            },
        ],
    },
];

export const socialsMenus = [
    {
        title: "Ponpes",
        subMenus: [],
    },
    {
        title: "RA",
        subMenus: [],
    },
    {
        title: "MTs",
        subMenus: [],
    },
    {
        title: "MA",
        subMenus: [
            {
                title: "ma_nurul_iman",
                icon: "fa-brands fa-instagram",
                url: "https://www.instagram.com/ma_nurul_iman/",
            },
            {
                title: "Ma Nurul Iman Sindangkerta",
                icon: "fa-brands fa-facebook",
                url: "https://www.facebook.com/manurulimansindangkerta/",
            },
            {
                title: "Ma Nurul Iman Sindangkerta",
                icon: "fa-brands fa-youtube",
                url: "https://www.youtube.com/@manurulimansindangkerta8640",
            },
            {
                title: "osis.ma.nuruliman",
                icon: "fa-brands fa-instagram",
                url: "https://www.instagram.com/osis.ma.nuruliman",
            },
            {
                title: "pramuka.manis",
                icon: "fa-brands fa-instagram",
                url: "https://www.instagram.com/pramuka.manis/",
            },
        ],
    },
];
