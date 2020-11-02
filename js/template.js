window.addEventListener('load', () => {
    // searchFrom -----------------------------------------------------
    const searchBtn = document.querySelector('.search--button');
    const searchForm = document.querySelector('form.search--form');
    let isSearchFormOpen = false;

    const searchFormOnClick = event => {
        if (!event.target.closest('form.search--form')) {
            searchBtn.click();
        }
    };

    searchBtn.addEventListener('click', event => {
        event.stopPropagation();

        if (isLanguageVariableOpen) {
            languageBtn.click();
        }

        if (isMenuOpen) {
            menuBtn.click();
        }

        if (isSearchFormOpen) {
            searchForm.classList.add('search--form-disabled');
            isSearchFormOpen = false;
            document.removeEventListener('click', searchFormOnClick);
        } else {
            searchForm.classList.remove('search--form-disabled');
            isSearchFormOpen = true;
            document.addEventListener('click', searchFormOnClick);
        }
    });

    // languageSwitcher ------------------------------------------------
    const languageBtn = document.querySelector('.langSwitcher--currentLang');
    const languageVariable = document.querySelector('.langSwitcher--variables');
    let isLanguageVariableOpen = false;

    const languageSwitcherClick = event => {
        if (!event.target.closest('.langSwitcher--variables')) {
            languageBtn.click();
        }
    };

    languageBtn.addEventListener('click', event => {
        event.stopPropagation();

        if (isSearchFormOpen) {
            searchBtn.click();
        }

        if (isMenuOpen) {
            menuBtn.click();
        }

        if (isLanguageVariableOpen) {
            languageVariable.classList.add('langSwitcher--variables-hidden');
            isLanguageVariableOpen = false;
            document.removeEventListener('click', languageSwitcherClick);
        } else {
            languageVariable.classList.remove('langSwitcher--variables-hidden');
            isLanguageVariableOpen = true;
            document.addEventListener('click', languageSwitcherClick);
        }
    });

    // menu -------------------------------------------------------------------------
    const menuBtn = document.querySelector('.navigation--btn');
    const menuBlock = document.querySelector('.navigation--menu');
    let isMenuOpen = false;

    const menuHeaders = document.querySelectorAll('.navigation--header[data-lvl="1"]');

    let menuItemOpen = [false, false, false];

    const mediaQuery700 = window.matchMedia('(min-width: 700px)')

    const menuClick = event => {
        if (!event.target.closest('.navigation--menu')) {
            menuBtn.click();
        }
    };

    menuBtn.addEventListener('click', event => {
        event.stopPropagation();

        if (isLanguageVariableOpen) {
            languageBtn.click();
        }

        if (isSearchFormOpen) {
            searchBtn.click();
        }

        if (isMenuOpen) {
            menuBlock.classList.remove('navigation--menu-active');
            isMenuOpen = false

            document.removeEventListener('click', menuClick);
        } else {
            menuBlock.classList.add('navigation--menu-active');
            isMenuOpen = true
            document.addEventListener('click', menuClick);
        }
    });

    const menuItemToggle = event => {
        const header = event.target.closest('.navigation--header');

        if (header) {
            switch(header.dataset.lvl) {
                case '1':
                    if (menuItemOpen[0]) {
                        if (menuItemOpen[1]) {
                            if (menuItemOpen[2]) {
                                menuItemOpen[2].classList.remove('navigation--header-active');
                                menuItemOpen[2] = false;
                            }
                            menuItemOpen[1].classList.remove('navigation--header-active');
                            menuItemOpen[1] = false;
                        }
                        menuItemOpen[0].classList.remove('navigation--header-active');
                    }

                    if (menuItemOpen[0] != header) {
                        menuItemOpen[0] = header;
                        header.classList.add('navigation--header-active');
                    } else {
                        menuItemOpen[0] = false;
                    }
                    break;
                case '2':
                    if (menuItemOpen[1]) {
                        if (menuItemOpen[2]) {
                            menuItemOpen[2].classList.remove('navigation--header-active');
                            menuItemOpen[2] = false;
                        }
                        menuItemOpen[1].classList.remove('navigation--header-active');
                    }

                    if (menuItemOpen[1] != header) {
                        menuItemOpen[1] = header;
                        header.classList.add('navigation--header-active');
                    } else {
                        menuItemOpen[1] = false;
                    }
                    break;
                case '3':
                    if (menuItemOpen[2]) {
                        menuItemOpen[2].classList.remove('navigation--header-active');
                    }

                    if (menuItemOpen[2] != header) {
                        menuItemOpen[2] = header;
                        header.classList.add('navigation--header-active');
                    } else {
                        menuItemOpen[2] = false;
                    }
                    break
            }
        }
    }

    let menuHeaderOpen = false;

    const closeSubMenu = () => {
        if (menuHeaders) {
            menuHeaderOpen.classList.remove('navigation--item-active');
            menuHeaderOpen.removeEventListener('mouseleave', closeSubMenu);
            menuHeaderOpen = false;
        }
    }

    const openSubMenu = event => {
        if (!menuHeaderOpen) {
            menuHeaderOpen = event.srcElement.closest('.navigation--item-lvl1');
            menuHeaderOpen.classList.add('navigation--item-active');
            menuHeaderOpen.addEventListener('mouseleave', closeSubMenu);
        }
    }

    if (!mediaQuery700.matches) {
        menuBlock.addEventListener('click', menuItemToggle);
    } else {
        menuHeaders.forEach(item => item.addEventListener('mouseover', openSubMenu));
    }

    mediaQuery700.addEventListener('change', () => {
        if (isMenuOpen) {
            menuBtn.click();
        }

        if (mediaQuery700.matches) {
            if (menuItemOpen[0]) {
                if (menuItemOpen[1]) {
                    if (menuItemOpen[2]) {
                        menuItemOpen[2].classList.remove('navigation--header-active');
                        menuItemOpen[2] = false;
                    }

                    menuItemOpen[1].classList.remove('navigation--header-active');
                    menuItemOpen[1] = false;
                }

                menuItemOpen[0].classList.remove('navigation--header-active');
                menuItemOpen[0] = false;
            }
            menuBlock.removeEventListener('click', menuItemToggle);
        } else {
            menuBlock.hidden = true;
            setTimeout(() => menuBlock.hidden = false, 300);
            menuBlock.addEventListener('click', menuItemToggle);
        }
    })
});
