let SAVED_PICS = [
    {
        name: "Dog1",
        src: "https://as2.ftcdn.net/v2/jpg/01/35/41/17/1000_F_135411789_S8C5aiQNMaJ7d8yinDEQfBjd1KDVW34p.jpg",
    },
    {
        name: "Dog2",
        src: "https://witzig.com/cdn/shop/articles/Blog-Images_0001_How-Many-Types.png?v=1586210647",
    },
    {
        name: "Dog3",
        src: "https://static.independent.co.uk/s3fs-public/thumbnails/image/2015/06/10/10/jCubeDog.jpg?width=1200",
    },
    {
        name: "Dog4",
        src: "https://as2.ftcdn.net/v2/jpg/02/21/34/41/1000_F_221344121_O4ykj4c1xEf4zCCmrGWchgkKwMWptBO8.jpg",
    },
    {
        name: "Dog5",
        src: "https://images.squarespace-cdn.com/content/v1/58b4791ad2b857c893179e34/1537971642021-LHW76T7O8JG0M4GLTSTP/IMG_2818.jpg?format=500w",

    },
    {
        name: "Dog6",
        src: "https://i.natgeofe.com/n/87908698-fc7a-4ada-ba21-490521df2511/01-domesticated-dog_square.jpg",
    },
    {
        name: "Dog7",
        src: "https://i.natgeofe.com/n/4f5aaece-3300-41a4-b2a8-ed2708a0a27c/domestic-dog_thumb_square.jpg",
    },
    {
        name: "Dog8",
        src: "https://ethicalfrenchie.com/uploads/cream-1.jpg"
    }
];

const hideAllPages = () => {
    document.getElementById("js-find-pic").classList.add("hidden");
    document.getElementById("js-saved-pic").classList.add("hidden");
    document.getElementById("js-page").classList.add("hidden");
}

const openFindDogPage = () => {
    hideAllPages();
    document.getElementById("js-find-pic").classList.remove("hidden");
    document.getElementById("js-home-btn").classList.remove("hidden");
    document.getElementById("js-title").textContent = "Find a Picture";
}

const openSavedPage = () => {
    hideAllPages();
    document.getElementById("js-saved-pic").classList.remove("hidden");
    document.getElementById("js-home-btn").classList.remove("hidden");
    document.getElementById("js-title").textContent = "Saved Pictures";
    document.getElementById("js-modify-btn").classList.remove("hidden");
    document.getElementById("js-save-btn").classList.add("hidden");
    const imgWr = document.getElementById("js-thumbnails");
    imgWr.innerHTML = "";
    for(let i = 0; i < SAVED_PICS.length; i++) {
        const pic = SAVED_PICS[i];
        imgWr.innerHTML += ` 
        <div class="image-wrap">
            <img src="${pic.src}" alt="${pic.name}">
        </div> 
        `;
    }
}

const deleteItem = name => {
    SAVED_PICS = SAVED_PICS.filter(pic => pic.name !== name); 
    modifySavedPage();
}

const modifySavedPage = () => {
    document.getElementById("js-modify-btn").classList.add("hidden");
    document.getElementById("js-save-btn").classList.remove("hidden");
    document.getElementById("js-title").textContent = "Modify Pictures";
    const imgWr = document.getElementById("js-thumbnails");
    imgWr.innerHTML = "";
    for(let i = 0; i < SAVED_PICS.length; i++) {
        const pic = SAVED_PICS[i];
        imgWr.innerHTML += ` 
        <div class="image-wrap">
            <img src="${pic.src}" alt="${pic.name}">
            <div class="delete-btn">
                <button onClick="deleteItem('${pic.name}')" class="delete btn btn-warning p-1">Delete</button>
            </div>
        </div> 
        `;
    }
}

const openHomePage = () => {
    hideAllPages();
    document.getElementById("js-page").classList.remove("hidden");
    document.getElementById("js-title").textContent = "Welcome!";
}

const main = () => {
    document.getElementById("js-find-btn").addEventListener("click", openFindDogPage);
    document.getElementById("js-view-saved-btn").addEventListener("click", openSavedPage);
    document.getElementById("js-home-btn").addEventListener("click", openHomePage);
    document.getElementById("js-modify-btn").addEventListener("click", modifySavedPage);
    document.getElementById("js-save-btn").addEventListener("click", openSavedPage);
    
}

main();