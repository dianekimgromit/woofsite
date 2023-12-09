'use strict';

const renderError = message => {
    document.getElementById('js-err-wr').classList.remove('hidden');
    document.getElementById('js-err-message').innerHTML = message;
}

const renderInfo = message => {
    document.getElementById('js-info-wr').classList.remove('hidden');
    document.getElementById('js-info-message').innerHTML = message;
}

const handleSignupClick = () => {
    document.getElementById('js-login-wr').classList.add('hidden');
    document.getElementById('js-signup-wr').classList.remove('hidden');
}

const handleLoginClick = () => {
    document.getElementById('js-signup-wr').classList.add('hidden');
    document.getElementById('js-login-wr').classList.remove('hidden');
}

const handleSignup = e => {
    e.preventDefault();
    const password = e.target.password.value;
    const confirmPassword = e.target.confirmPassword.value;
    const agreement = e.target.agreement.checked;
    if (!agreement) {
        renderError('Please indicate you have read and agree to the terms and conditions');
        return;
    }
    if (password !== confirmPassword) {
        renderError('Passwords do not match.');
        return;
    }
    document.getElementById('js-signup-form').submit();
}

const handleLogout = () => {
    localStorage.clear();
    window.location.href = './html';
  }

const addFavorite = (id, imageLink) => {
    const userID = localStorage.getItem('userID');
    if (!userID) return;

    const url = `./_addFavorite.php?dogId=${id}&userID=${userID}&imageLink=${imageLink}`;

    fetch(url)
        .then(response => {
        if (response.ok)  return response.text();
            throw new Error(response.statusText); 
        })
        .then(responseText => {
            if (responseText.includes("Success")) {
                renderInfo("Successfully Added");
            } else if (responseText.includes("Duplicate")) {
                renderError("This picture is already in your favorites.");
            } else {
                renderError(responseText);
            } 
        })
        .catch(err => {
            console.log('error', err);
        });   
}

const deleteFavorite = (id) => {
    const userID = localStorage.getItem('userID');
    if (!userID) return;

    const url = `./_deleteFavorite.php?dogId=${id}&userID=${userID}`;

    fetch(url)
        .then(response => {
        if (response.ok)  return response.text();
            throw new Error(response.statusText); 
        })
        .then(responseText => {
            if (responseText.includes("Success")) {
                document.getElementById('js-info-wr').setAttribute('onclick', `window.location.href = './saved.php?userID=${userID}'`);
                renderInfo("Successfully Deleted");
            } else {
                renderError(responseText);
            } 
        })
        .catch(err => {
            console.log('error', err);
        });
   
}

const updateDesc = () => {
    const userID = localStorage.getItem('userID');
    if (!userID) return;

    const desc = document.getElementById('js-note').value;

    const url = `./_updateDesc.php?desc=${desc}&userID=${encodeURIComponent(userID)}`;

    fetch(url)
        .then(response => {
        if (response.ok)  return response.text();
            throw new Error(response.statusText); 
        })
        .then(responseText => {
            if (responseText.includes("Success")) {
                document.getElementById('js-info-wr').setAttribute('onclick', `window.location.href = './saved.php?userID=${userID}'`);
                renderInfo("Description Updated");
            } else {
                renderError(responseText);
            } 
        })
        .catch(err => {
            console.log('error', err);
        });   
}


const renderDogImages = pics => {
    const fname = localStorage.getItem('fname');

    document.getElementById('js-message-title').innerHTML = fname ? 'Please click to add to your favorites' : 'Please log in to save your favorites.';

    const picElem = document.getElementById('js-dog-pics-wr');
    picElem.innerHTML = '';
    pics.forEach(pic => {
        const { id, url } = pic;
        if (fname) {
            picElem.innerHTML += `
                <div onclick="addFavorite('${id}', '${url}');" class='pic-item fi-short pointer'>
                    <img class='pic' src='${url}'>
                    <i class="fa fa-paw icon fi-short pointer" style="color:#B22E19;font-size:8rem;"></i>
                </div>`;
        } else {
            picElem.innerHTML += `
                <div class='pic-item fi-short'>
                    <img class='pic' src='${url}'>
                </div>`;
        }

    });
    document.getElementById('js-header3').scrollIntoView({ behavior: "smooth", block: "start" });
}

const fetchDogs = id => {
    const url = `https://api.thedogapi.com/v1/images/search?limit=20&breed_ids=${id}`;

    fetch(url)
      .then(response => {
        if (response.ok)  return response.json();
        throw new Error(response.statusText); /* catch server defined errors e.g, 404 */
      })
      .then(responseJson => {
        renderDogImages(responseJson);
      })
      .catch(err => {
        console.log('error' + err.message);
      });

}

const renderBreed = (breed = '') => {
    const breedList = document.getElementById('js-breed-list');
    const listTitle = document.getElementById('js-breed-list-title');
    listTitle.classList.remove('hidden');
    breedList.innerHTML = '';
    let count = 0;

    BREEDS.forEach(item => {
        const { id, name, temperament } = item;
        const isInclusive = breed !== '' && name.toLowerCase().includes(breed.toLowerCase());
        if (!isInclusive) return;
        count++;

        breedList.innerHTML += `
        <div class='r'>
            <div class="c1">
                <span onclick="fetchDogs(${id})" class="text-link pic-link">Show Pic &gt;</span> 
                ${name}
            </div>
            <div class="c2">
                ${temperament}
            </div>
        </div>
        `;
    })

    if (count === 0) listTitle.classList.add('hidden');
}

const handleSearchUpdate = e => {
    const breed = e.target.value;
    renderBreed(breed);
}

const main = () => {

    const pathname = window.location.pathname;
    const userID = localStorage.getItem('userID');
    const fname = localStorage.getItem('fname');

    if (fname) {
        document.getElementById('js-header1').innerHTML = fname;
        document.getElementById('js-login-link').classList.add('hidden');
        document.getElementById('js-logout-link').classList.remove('hidden');
        document.getElementById('js-sign-btn').classList.add('hidden');
        const elem = document.getElementById('js-saved-btn');
        elem.classList.remove('hidden');
        elem.setAttribute('onclick', `window.location.href = './saved.php?userID=${userID}'`);
    }

    if (pathname === '/' || pathname.includes('main')) {
        renderBreed();
        document.getElementById('js-breed').addEventListener('input', handleSearchUpdate);
    } else if (pathname.includes('sign')) {
        if (fname) {
            window.location.href = './main.php';
            return;
        }
        document.getElementById('js-sign-btn').classList.add('hidden');
        document.getElementById('js-signup-form').addEventListener('submit', handleSignup);
    } else if (pathname.includes('saved')) {
        if (!fname) {
            window.location.href = './main.php';
            return;
        }
        document.getElementById('js-sign-btn').classList.add('hidden');
        document.getElementById('js-saved-btn').classList.add('hidden');
        document.getElementById('js-fav-name').innerHTML = fname;
        document.getElementById('js-note').addEventListener('input', ()=> {
            const btn = document.getElementById('js-update-desc-btn');
            btn.classList.add('btn-red');
            btn.classList.add('pointer');

            btn.removeAttribute('disabled');
        });

    }
}

main();