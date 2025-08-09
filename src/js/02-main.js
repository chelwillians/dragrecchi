function getSelectedText(name) {
    const el = document.querySelector(`select[name="${name}"]`);

    let result = [];
    let options = el && el.options;
    let opt;

    for (let i = 0, iLen = options.length; i < iLen; i++) {
        opt = options[i];

        if (opt.selected) {
            result.push(opt.value || opt.text);
        }
    }
    return result;
    // return el ? el.options[el.selectedIndex]?.text.trim() : '';
}

document.addEventListener("DOMContentLoaded", (event) => {
    const swiper = new Swiper(".units__list", {
        rewind: true,
        spaceBetween: 16,
        slidesPerView: "auto",
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },
    });
});

document.addEventListener("DOMContentLoaded", (event) => {
    const swiper = new Swiper(".video-slider__list", {
        rewind: true,
        spaceBetween: 16,
        slidesPerView: "auto",
        autoplay: false,
    });
});

document.addEventListener("DOMContentLoaded", (event) => {
    const swiper = new Swiper(".main-banner__list", {
        rewind: true,
        slidesPerView: 1,
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.main-banner__next',
            prevEl: '.main-banner__prev',
        },
        pagination: {
            el: '.main-banner__pagination',
            clickable: true,
        },
    });
});

document.addEventListener("DOMContentLoaded", (event) => {
    const shadow = document.querySelector('.shadow');
    const floatButtons = document.querySelectorAll('.float-buttons__item');
    const modalClose = document.querySelectorAll('.modals__item-close');

    floatButtons.forEach((el) => {
        el.addEventListener('click', () => {
            document.querySelector(`.modals__item.active`)?.classList.remove('active')
            shadow.classList.remove('active')

            let dataOpen = el.dataset.modalOpen;
            document.querySelector(`.modals__item[data-modal-open="${dataOpen}"]`).classList.add('active')
            shadow.classList.add('active')
            document.body.classList.add('no-scroll')
        })
    })

    shadow.addEventListener('click', () => {
        document.querySelector(`.modals__item.active`)?.classList.remove('active')
        shadow.classList.remove('active')
    })

    modalClose.forEach((el) => {
        el.addEventListener('click', () => {
            document.querySelector(`.modals__item.active`)?.classList.remove('active')
            shadow.classList.remove('active')
        })
    })
});

document.addEventListener("DOMContentLoaded", (event) => {
    const search = document.querySelector('.main-header__search');

    search?.addEventListener('click', (e) => {
        e.stopPropagation();
        search.classList.add('active');
    })

    document.addEventListener('click', (e) => {
        if (!search?.contains(e.target)) {
            search?.classList.remove('active');
        }
    });
});

document.addEventListener("DOMContentLoaded", (event) => {
    let pessoa_celular = document.querySelector('.mosaic__item--illustration');
    if (pessoa_celular) {
        bodymovin.loadAnimation({
            container: pessoa_celular,
            path: directoryURI + "/dist/lotties/personagem_celular.json",
            render: 'svg',
            loop: true,
            autoplay: true
        })
    }
});

document.addEventListener("DOMContentLoaded", (event) => {
    let door = document.querySelector('.call-calculate__image');
    if (door) {
        bodymovin.loadAnimation({
            container: door,
            path: directoryURI + "/dist/lotties/boxe-home.json",
            render: 'svg',
            loop: true,
            autoplay: true
        })
    }
});

document.addEventListener("DOMContentLoaded", (event) => {
    const swiper = new Swiper(".internal-banner__slider-list", {
        rewind: true,
        slidesPerView: 1,
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.internal-banner__next',
            prevEl: '.internal-banner__prev',
        },
    });
});

document.addEventListener("DOMContentLoaded", (event) => {
    const swiper = new Swiper(".benefits__list", {
        rewind: true,
        spaceBetween: 16,
        slidesPerView: "auto",
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.benefits__pagination',
            clickable: true,
        },
    });
});

document.addEventListener("DOMContentLoaded", (event) => {
    const shadow = document.querySelector('.shadow');
    const spaceDefiners = document.querySelectorAll('.space-definer__item');
    const modalClose = document.querySelectorAll('.space-definer__modal-close');

    spaceDefiners.forEach((el) => {
        el.addEventListener('click', () => {
            document.querySelector(`.space-definer__modal.active`)?.classList.remove('active')
            shadow.classList.remove('active')

            let dataOpen = el.dataset.open;
            document.querySelector(`.space-definer__modal[data-open="${dataOpen}"]`).classList.add('active')
            shadow.classList.add('active')
            document.body.classList.add('no-scroll')
        })
    })

    shadow.addEventListener('click', () => {
        document.querySelector(`.space-definer__modal.active`)?.classList.remove('active')
        shadow.classList.remove('active')
    })

    modalClose.forEach((el) => {
        el.addEventListener('click', () => {
            document.querySelector(`.space-definer__modal.active`)?.classList.remove('active')
            shadow.classList.remove('active')
        })
    })
});

document.addEventListener('DOMContentLoaded', () => {
    const faq = document.querySelectorAll('.faq');
    if (!faq) return;

    faq[0]?.addEventListener('click', (e) => {
        if (!e.target.closest('.faq__item--answer')) {
            const question = e.target.closest('.faq__item');
            question.classList.toggle('active');
        }
    })
});

document.addEventListener("DOMContentLoaded", (event) => {
    const swiper1 = new Swiper(".flexibility__slider", {
        rewind: true,
        slidesPerView: 1,
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },
        effect: 'fade',
        fadeEffect: {
            crossFade: true
        },
        on: {
            slideChange: function (e) {
                document.querySelector('.flexibility__controll-item.active').classList.remove('active')
                controlls[e.activeIndex].classList.add('active')
            },
        },
    });

    const controlls = document.querySelectorAll('.flexibility__controll-item')

    controlls[0]?.classList.add('active');

    controlls.forEach((el, i) => {
        el.addEventListener('click', () => {
            document.querySelector('.flexibility__controll-item.active').classList.remove('active')
            el.classList.add('active')
            swiper1.slideTo(i, 100)
        })
    })
});

document.addEventListener("DOMContentLoaded", (event) => {
    const swiper = new Swiper(".testimonials__list", {
        rewind: true,
        spaceBetween: 16,
        slidesPerView: "auto",
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },
    });
});

document.addEventListener("DOMContentLoaded", (event) => {
    Fancybox.bind("[data-fancybox]", {
        // Your custom options
        Toolbar: {
            enabled: false
        }
    });

    const swiper = new Swiper(".gallery__list", {
        rewind: true,

        slidesPerView: 1,
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },
        breakpoints: {
            1024: {
                slidesPerView: 3,
            }
        },
        navigation: {
            nextEl: '.gallery__next',
            prevEl: '.gallery__prev',
        },
        pagination: {
            el: '.gallery__pagination',
            clickable: true,
        },
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const filterForm = document.querySelector('.our-units__form');
    const filterInput = document.querySelector('.our-units__input');
    const filterInputCoord = document.querySelector('.our-units__form input[type="hidden"]');
    const filterItems = document.querySelectorAll('.our-units__item');
    const filterNotFound = document.querySelector('.our-units__item--empty');
    const useLocationButton = document.querySelector('.our-units #use_location');
    const buttonReset = document.querySelector('.our-units .our-units__filter-reset');

    filterForm?.addEventListener('submit', e => e.preventDefault());

    const haversine = (lat1, lon1, lat2, lon2) => {
        const toRad = deg => deg * Math.PI / 180;
        const R = 6371; // km
        const dLat = toRad(lat2 - lat1);
        const dLon = toRad(lon2 - lon1);
        const a = Math.sin(dLat / 2) ** 2 + Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) * Math.sin(dLon / 2) ** 2;
        return R * 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    };

    const isWithinRadius = (coord1, coord2, radius = 10) => {
        const [lat1, lon1] = coord1.split(',').map(Number);
        const [lat2, lon2] = coord2.split(',').map(Number);
        return haversine(lat1, lon1, lat2, lon2) <= radius;
    };

    const updateItemVisibility = () => {
        const valueInput = filterInput.value.toLowerCase().trim();
        const coordFilter = filterInputCoord.value;
        let hasVisibleItem = false;

        filterItems.forEach(item => {
            const text = item.textContent.toLowerCase();
            const itemCoord = item.getAttribute('data-coord') || "0,0";
            const matches = coordFilter
                ? isWithinRadius(itemCoord, coordFilter)
                : text.includes(valueInput);

            item.classList.toggle('active', matches);
            item.classList.toggle('off', !matches);
            if (matches) hasVisibleItem = true;
        });

        filterNotFound.classList.toggle('active', !hasVisibleItem);
    };

    const fillAddressInput = address => {
        filterInput.value = address;
        filterInput.dispatchEvent(new Event('keyup'));
    };

    const fillAddressInputCoord = coord => {
        filterInputCoord.value = coord;
        filterInput.dispatchEvent(new Event('keyup'));
    };

    const getLocation = () => {
        if (!useLocationButton.checked) {
            resetFilters();
            // return;
        }

        if (!navigator.geolocation) {
            alert("Geolocalização não é suportada pelo seu navegador.");
            return;
        }

        useLocationButton.classList.toggle('active');
        navigator.geolocation.getCurrentPosition(async ({ coords }) => {
            const { latitude, longitude } = coords;
            try {
                const res = await fetch(`https://nominatim.openstreetmap.org/reverse?lat=${latitude}&lon=${longitude}&format=json`);
                const data = await res.json();

                if (data?.display_name && useLocationButton.classList.contains('active')) {
                    fillAddressInput(data.address.city_district || '');
                    fillAddressInputCoord(`${data.lat}, ${data.lon}`);
                } else {
                    fillAddressInput('');
                }
            } catch {
                alert("Endereço não encontrado.");
            }
        }, () => {
            alert("Permissão para localização negada.");
        });
    };

    const resetFilters = () => {
        filterItems.forEach(el => {
            el.classList.add('active');
            el.classList.remove('off');
        });
        filterInputCoord.value = '';
        filterNotFound.classList.remove('active');
    };

    filterInput?.addEventListener('keyup', updateItemVisibility);
    useLocationButton?.addEventListener('click', getLocation);
    buttonReset?.addEventListener('click', resetFilters);
});


window.addEventListener('load', function () {
    const mainHeader = document.querySelector('.main-header');
    const hamburguerItem = document.querySelector('.main-header__hamburguer');
    // const headerMenus = document.querySelector('.main-header__menus--mobile');
    hamburguerItem.addEventListener('click', (e) => {
        hamburguerItem.classList.toggle('active');
        // headerMenus.classList.toggle('active');
        mainHeader.classList.toggle('active');
        document.querySelector('html').classList.toggle('no-scroll');
        document.body.classList.toggle('no-scroll');

    })
})

document.addEventListener("DOMContentLoaded", (event) => {
    const strategicPoint = document.querySelector('.strategic-point__list');
    if (strategicPoint && window.innerWidth < 1024) {
        new Swiper(strategicPoint, {
            rewind: true,
            spaceBetween: 16,
            centeredSlides: true,
            slidesPerView: "auto",
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
        });
    }
});

document.addEventListener("DOMContentLoaded", (event) => {
    if (document.querySelector('.steps__list')) {
        const swiperSteps = new Swiper(".steps__list", {
            rewind: true,
            spaceBetween: 16,
            centeredSlides: true,
            slidesPerView: "auto",
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
        });

        if (window.innerWidth >= 1024) {
            swiperSteps.destroy()
        }
    }
});

document.addEventListener("DOMContentLoaded", (event) => {
    if (document.querySelector('.our-units__list')) {
        const swiperOurUnits = new Swiper(".our-units__list", {
            rewind: true,
            spaceBetween: 16,
            centeredSlides: true,
            slidesPerView: "auto",
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
        });

        if (window.innerWidth >= 1024) {
            swiperOurUnits.destroy()
        }
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const swiperContainer = document.querySelector('.strategic-point__list');

    if (swiperContainer && window.innerWidth < 1024) {
        new Swiper(swiperContainer, {
            rewind: true,
            spaceBetween: 16,
            centeredSlides: true,
            slidesPerView: "auto",
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.strategic-point__pagination',
                clickable: true,
            },
        });
    }
});

document.addEventListener("DOMContentLoaded", (event) => {
    const buttonCopy = document.querySelector('.single-internal-banner__pre-title-links-item--copy');

    function copyText(e) {
        e.preventDefault();
        const texto = window.location.href;

        navigator.clipboard.writeText(texto).then(() => {
            alert("Link copiado com sucesso!");
        }).catch(err => {
            console.error("Erro ao copiar:", err);
        });
    }

    buttonCopy?.addEventListener('click', (e) => { copyText(e) })
});

document.addEventListener('DOMContentLoaded', () => {
    const closeRespose = document.querySelector('.contact-form__success-close');
    const wpcf7Elm = document.querySelector('.contact-form .wpcf7-form');
    const cfSuccess = document.querySelector('.contact-form__success');
    const shadow = document.querySelector('.shadow');
    const successAnimation = document.querySelector('.contact-form__success-content__animation');

    if (successAnimation) {
        bodymovin.loadAnimation({
            container: successAnimation,
            path: directoryURI + "/dist/lotties/check.json",
            render: 'svg',
            loop: true,
            autoplay: true
        })
    }

    wpcf7Elm?.addEventListener('wpcf7mailsent', function (event) {
        cfSuccess.classList.add('active');
        shadow.classList.add('active')
    }, false);

    closeRespose?.addEventListener('click', () => {
        shadow.classList.remove('active');
        cfSuccess.classList.remove('active');
    })

    shadow.addEventListener('click', () => {
        shadow.classList.remove('active');
        cfSuccess?.classList.remove('active');
    })
});

document.addEventListener("DOMContentLoaded", (event) => {
    const menuBlog = document.querySelector('.featured-topics__list');
    if (menuBlog && window.innerWidth < 1024) {
        const swiper = new Swiper(".featured-topics__list", {
            rewind: true,
            spaceBetween: 8,
            slidesPerView: "auto",
            freeMode: true
        });
    }
});

document.addEventListener("DOMContentLoaded", (event) => {
    const blogSelectSubject = document.querySelector('.blog-controls__select');
    if (blogSelectSubject) {
        blogSelectSubject.addEventListener('change', (e) => {
            if (e.target.value === '/') return
            window.location.href = homeURL + '/categoria/' + e.target.value
        })
    }
});

document.addEventListener("DOMContentLoaded", (event) => {
    const privacyMenu = document.querySelector('.privacy-policy__menu--mobile');
    const privacyMenuDesk = document.querySelectorAll('.privacy-policy__menu-item');
    if (privacyMenu) {
        privacyMenu.addEventListener('change', (e) => {
            if (e.target.value === '/') return
            document.querySelector(`${e.target.value}`).scrollIntoView({
                behavior: 'smooth'
            });
        })
    }

    if (privacyMenuDesk) {
        privacyMenuDesk.forEach((el) => {
            el.addEventListener('click', (e) => {
                document.querySelector('.privacy-policy__menu-item.active')?.classList.remove('active');
                el.classList.add('active');
            })
        })
    }
});

document.addEventListener("DOMContentLoaded", (event) => {
    const filterForm = document.querySelector('.all-units .our-units__form');
    const filterInput = document.querySelector('.all-units .our-units__input');
    const filterItems = document.querySelectorAll('.all-units .units__item');
    const filterNotFound = document.querySelector('.all-units .units__item--empty');
    const useLocationButton = document.querySelector('.all-units .our-units #use_location'); // Botão para usar localização
    const filterTag = document.querySelectorAll('.all-units .all-units__tag-filter-item'); // Botão para usar localização

    filterForm?.addEventListener('submit', function (event) {
        event.preventDefault();
    });

    // Função para preencher o input com o endereço
    function fillAddressInput(address) {
        filterInput.value = address;
        filterInput.dispatchEvent(new Event('keyup')); // Aciona o evento para filtrar os itens
    }

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(async (position) => {
                const { latitude, longitude } = position.coords;

                const response = await fetch(`https://nominatim.openstreetmap.org/reverse?lat=${latitude}&lon=${longitude}&format=json`);
                const data = await response.json();

                if (data && data.display_name) {
                    fillAddressInput(data.address.city_district);
                } else {
                    alert("Endereço não encontrado.");
                }
            }, () => {
                alert("Permissão para localização negada.");
            });
        } else {
            alert("Geolocalização não é suportada pelo seu navegador.");
        }
    }

    useLocationButton?.addEventListener('click', getLocation);

    filterInput?.addEventListener('keyup', (e) => {
        const valueInput = e.target.value.toLowerCase().trim();

        filterItems.forEach(element => {
            const itemText = element.textContent.toLowerCase();
            if (itemText.includes(valueInput)) {
                element.classList.add('active');
                element.classList.remove('off');
            } else {
                element.classList.add('off');
                element.classList.remove('active');
            }

            if (document.querySelectorAll('.units__item.off').length == filterItems.length) {
                filterNotFound.classList.add('active');
            } else {
                filterNotFound.classList.remove('active');
            }
        });
    });

    filterTag.forEach(element => {
        element.addEventListener('click', () => {
            document.querySelector('.all-units .all-units__tag-filter-item.active')?.classList.remove('active');
            element.classList.add('active');
            let dataOpen = element.dataset.open.toLowerCase();

            if (dataOpen === "all") {
                document.querySelectorAll('.units__item.off').forEach(element => {
                    element.classList.remove('off');
                });

                return;
            }
            filterItems.forEach(element => {
                const itemText = element.textContent.toLowerCase();
                if (itemText.includes(dataOpen)) {
                    element.classList.add('active');
                    element.classList.remove('off');
                } else {
                    element.classList.add('off');
                    element.classList.remove('active');
                }

                if (document.querySelectorAll('.units__item.off').length == filterItems.length) {
                    filterNotFound.classList.add('active');
                } else {
                    filterNotFound.classList.remove('active');
                }
            });
        })
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const optionsTiposTag = document.querySelectorAll('.tipos-tags .tipos-tags-item');
    const faqList = document.querySelectorAll('.faq .faq__list .faq__item');

    optionsTiposTag.forEach((el) => {
        el.addEventListener('click', () => {
            document.querySelector('.tipos-tags .tipos-tags-item.active').classList.remove('active');
            el.classList.add('active');

            const dataTipo = el.dataset.tipo;

            faqList.forEach((faq) => {
                if (dataTipo === 'all' || faq.dataset.tipo.includes(dataTipo)) {
                    faq.classList.add('on');
                    faq.classList.remove('off');

                    faq.classList.remove('aos-animate');
                    void faq.offsetWidth; // Força reflow
                    faq.classList.add('aos-animate');
                } else {
                    faq.classList.add('off');
                    faq.classList.remove('on');
                }
            });

            // Roda AOS novamente
            AOS.refreshHard();

            // Se quiser rolar pro topo
            window.scrollTo({
                top: 0,
                left: 0,
                behavior: "instant"
            });
        });
    });
});

let currentStep = 0;
document.addEventListener("DOMContentLoaded", () => {
    if (document.querySelector(`.modals__item--request-quote`)) {
        const steps = document.querySelectorAll(".step");
        const progress = document.querySelectorAll(".progress");
        const buttonReset = document.querySelectorAll(".navigation .reset");
        const selectUnits = document.querySelectorAll("#id_unidade option");

        const argsChoices = {
            maxItemCount: 3,
            loadingText: 'Carregando...',
            noResultsText: 'Sem resultados',
            noChoicesText: 'Nenhuma opção para escolher',
            itemSelectText: 'Pressione para selecionar',
            uniqueItemText: 'Apenas valores únicos podem ser adicionados',
            customAddItemText: 'Somente valores que correspondem a condições específicas podem ser adicionados',
            addItemText: (value, rawValue) => {
                return `Pressione Enter para adicionar <b>"${value}"</b>`;
            },
            removeItemIconText: () => `Remover item`,
            removeItemLabelText: (value, rawValue) => `Remover item: ${value}`,
            maxItemText: (maxItemCount) => {
                return `Apenas ${maxItemCount} ite${maxItemCount > 1 ? 'ns' : 'm'} pode${maxItemCount > 1 ? 'm' : ''} ser adicionado${maxItemCount > 1 ? 's' : ''}`;
            },
            sorter: () => { }
        }

        let choices = document.getElementById('id_unidade') ? new Choices(document.getElementById('id_unidade'), argsChoices) : '';
        const choices2 = document.getElementById('metragembox') ? new Choices(document.getElementById('metragembox'), { ...argsChoices, maxItemCount: 1 }) : '';

        function showStep(index) {
            steps.forEach((step, i) => {
                step.classList.toggle("active", i === index);
            });
            validateStep(index); // Verifica os campos ao exibir
        }

        function validateStep(index) {
            const step = steps[index];
            const inputs = step?.querySelectorAll("input[type='radio'], input[type='text'], input[type='tel'], input[type='email'], input[type='checkbox'], select");
            const nextButton = step?.querySelector(".next") || step?.querySelector("input[value='Continuar']");

            let isValid = true;

            const groupedRadios = {};
            inputs?.forEach(input => {
                if (input.type === "radio") {
                    if (!groupedRadios[input.name]) {
                        groupedRadios[input.name] = step.querySelectorAll(`input[type="radio"][name="${input.name}"]`);
                    }
                }
            });

            inputs?.forEach(input => {
                if (input.type === "radio") {
                    const group = groupedRadios[input.name];
                    const anyChecked = [...group].some(radio => radio.checked);
                    if (!anyChecked) {
                        isValid = false;
                    }
                } else if (input.tagName === "SELECT") {
                    if (input.selectedOptions.length === 0) {
                        isValid = false;
                    }
                } else if (input.type === "text" || input.type === "tel" || input.type === "email") {
                    if (input.value.trim() === "") {
                        isValid = false;
                    }
                } else if (input.type === "checkbox") {
                    if (!input.checked) {
                        isValid = false;
                    }
                }
            });

            if (nextButton) {
                nextButton.classList.toggle("active", isValid);
            }
        }

        function getCheckedValue(name) {
            const el = document.querySelector(`input[name="${name}"]:checked`);
            return el ? el.nextElementSibling?.textContent.trim() || el.value : '';
        }

        function getInputValue(name) {
            const el = document.querySelector(`[name="${name}"]`);
            return el ? el.value.trim() : '';
        }

        function pushStepToDataLayer(stepIndex) {
            let interesse = getCheckedValue("cf_qual_o_seu_interesse_produto");
            let uso = getCheckedValue("cf_tipo_pessoa");
            let unidade = getSelectedText("cf_id_unidade");
            let tamanho_espaco = getSelectedText("cf_metragem_box");
            let nome = getInputValue("name");
            let email = getInputValue("email");
            let telefone = getInputValue("mobile_phone");
            let name = `etapa${stepIndex + 1}_solicitar_orcamento`;

            if (stepIndex === 0) {
                window.dataLayer = window.dataLayer || [];
                window.dataLayer.push({
                    event: name,
                    interesse: interesse || "",
                    uso: uso || ""
                });

                selectUnits.forEach(element => {
                    if (element.dataset.tipo == "default") return;
                    if (interesse?.toLowerCase() == "ainda não me decidi") return;
                    if (interesse?.toLowerCase() == "Galpões urbanos".toLowerCase()) {
                        if (element.dataset.tipo?.toLowerCase() === "Self Storage".toLowerCase()) {
                            element.setAttribute('disabled', '');

                            choices.destroy();
                            choices = new Choices('#id_unidade', argsChoices);

                            return
                        }
                        return
                    }
                    if (element.dataset.tipo?.toLowerCase() != interesse?.toLowerCase()) {
                        element.setAttribute('disabled', '');

                        choices.destroy();
                        choices = new Choices('#id_unidade', argsChoices);
                    } else {
                        element.removeAttribute('disabled');
                    }
                });
            }

            if (currentStep === 1) {
                window.dataLayer = window.dataLayer || [];
                window.dataLayer.push({
                    event: name,
                    interesse: interesse || "",
                    uso: uso || "",
                    unidade: unidade || "",
                    tamanho_espaco: tamanho_espaco || ""
                });
            }

            if (currentStep === 2) {
                window.dataLayer = window.dataLayer || [];
                window.dataLayer.push({
                    event: "form_orcamento_site",
                    interesse: interesse || "",
                    uso: uso || "",
                    unidade: unidade || "",
                    tamanho_espaco: tamanho_espaco || "",
                    nome: nome || "",
                    email: email || "",
                    telefone: telefone || ""
                });
            }
        }

        steps.forEach((step, index) => {
            const inputs = step.querySelectorAll("input[type='radio'], input[type='checkbox'], input[type='text'], input[type='email'], input[type='tel'], select");

            inputs.forEach((input) => {
                const eventType = input.type === "text" ? "input" : "change";
                input.addEventListener(eventType, () => {
                    validateStep(index);
                });
            });

            const nextBtn = step.querySelector(".next") || step.querySelector("input[value='Continuar']");
            if (nextBtn) {
                nextBtn.addEventListener("click", () => {
                    if (nextBtn.classList.contains("active")) {
                        pushStepToDataLayer(currentStep);
                        currentStep++;
                        showStep(currentStep);
                    }

                    progress[currentStep]?.classList.add('active');
                });
            }

            const backBtn = step.querySelector("input[value='Voltar']");
            if (backBtn) {
                backBtn.addEventListener("click", () => {
                    progress[currentStep].classList.remove('active')
                    currentStep--;
                    showStep(currentStep);
                });
            }
        });

        showStep(currentStep);

        // Animacao form
        const successfulForm = document.querySelector('.successful-step');
        if (successfulForm) {
            bodymovin.loadAnimation({
                container: successfulForm,
                path: directoryURI + "/dist/lotties/check.json",
                render: 'svg',
                loop: true,
                autoplay: true
            });
        }

        const sendingForm = document.querySelector('.sending-step');
        if (sendingForm) {
            bodymovin.loadAnimation({
                container: sendingForm,
                path: directoryURI + "/dist/lotties/sending.json",
                render: 'svg',
                loop: true,
                autoplay: true
            });
        }

        const errorForm = document.querySelector('.error-step');
        if (errorForm) {
            bodymovin.loadAnimation({
                container: errorForm,
                path: directoryURI + "/dist/lotties/error-2.json",
                render: 'svg',
                loop: true,
                autoplay: true
            });
        }

        buttonReset.forEach((el) => {
            el.addEventListener('click', () => {
                showStep(0);
                progress.forEach(el => el.classList.remove('active'));
                progress[0].classList.add('active');
                currentStep = 0;
                stepIndex = 0;
                document.querySelector("#form-orcamento")?.reset();

                document.querySelector(".step--error")?.classList.remove('active');
                document.querySelector(".step--end")?.classList.remove('active');
            });
        })

    }
});

document.addEventListener("DOMContentLoaded", () => {
    const shadow = document.querySelector('.shadow');
    const openWhatsApp = document.querySelectorAll('a[data-open-whatsapp]')

    if (openWhatsApp) {
        openWhatsApp.forEach((el) => {
            el.addEventListener('click', (e) => {
                e.preventDefault();

                document.querySelector(`.modals__item--whatsapp`).classList.add('active')
                shadow.classList.add('active')
                document.body.classList.add('no-scroll')

            })
        })
    }

    const openRequestQuote = document.querySelectorAll('a[data-request-quote]')

    if (openRequestQuote) {
        openRequestQuote.forEach((el) => {
            el.addEventListener('click', (e) => {
                e.preventDefault();

                document.querySelector(`.modals__item--request-quote`).classList.add('active')
                shadow.classList.add('active')
                document.body.classList.add('no-scroll')

            })
        })
    }
});

document.addEventListener("DOMContentLoaded", (event) => {
    const menuBlog = document.querySelector('.tipos-tags__list');
    if (menuBlog && window.innerWidth < 1024) {
        const swiper = new Swiper(".tipos-tags__list", {
            rewind: true,
            spaceBetween: 8,
            slidesPerView: "auto",
            freeMode: true
        });
    }
});

document.addEventListener("DOMContentLoaded", (event) => {
    const blogList = document.querySelector('.blog-list__list');
    if (blogList && window.innerWidth < 1024) {
        const swiper = new Swiper(blogList, {
            rewind: true,
            spaceBetween: 16,
            slidesPerView: "auto",
        });
    }
});

document.addEventListener("DOMContentLoaded", (event) => {
    let pessoa_celular = document.querySelector('.safety__illustration');
    if (pessoa_celular) {
        bodymovin.loadAnimation({
            container: pessoa_celular,
            path: directoryURI + "/dist/lotties/sobre.json",
            render: 'svg',
            loop: true,
            autoplay: true
        })
    }
});

document.addEventListener("DOMContentLoaded", (event) => {
    const element = document.getElementById('telefone');
    const element2 = document.getElementById('telefone-request-order');
    const element3 = document.querySelector('.phone-mask');
    const allInputTel = document.querySelectorAll('input[type="tel"]');
    const maskOptions = {
        mask: '(00) 00000-0000'
    };
    if (element) {
        const mask = IMask(element, maskOptions);
    }
    if (element2) {
        const mask2 = IMask(element2, maskOptions);
    }

    if (element3) {
        const mask3 = IMask(element3, maskOptions);
    }

    if (allInputTel) {
        allInputTel.forEach((el, i) => {
            let maskAll = IMask(el, maskOptions);
        })
    }
});

document.addEventListener("DOMContentLoaded", (event) => {
    const menu = document.querySelector('.main-header');
    const menuHeight = menu.offsetHeight;

    window.addEventListener('scroll', () => {
        if (window.scrollY > menuHeight * 2) {
            menu.classList.add("is-fixed");
            document.body.style.paddingTop = `${menuHeight}px`;
        } else {
            menu.classList.remove("is-fixed");
            document.body.style.paddingTop = "0";
        }
    })
});

document.addEventListener("DOMContentLoaded", (event) => {
    const wppForm = document.querySelector('.modals__item--whatsapp .wpcf7-form')
    const wppFormBtn = document.querySelector('.modals__item--whatsapp .wpcf7-form .wpcf7-submit')
    const wppFormSubmitLinkElement = document.querySelector('.link-submit')

    let redirect;
    if (document.body.classList.contains('page-template-landing_pagesself-storage-php')) {
        redirect = 'https://wa.me/551122221220?text=Ol%C3%A1%2C%20gostaria%20de%20mais%20informa%C3%A7%C3%B5es%20sobre%20Self%20Storage';
    } else {
        redirect = wppFormSubmitLinkElement.value
    }

    wppForm?.addEventListener('wpcf7mailsent', function (event) {
        const nomeInput = document.querySelector('.modals__item--whatsapp input[name="your-name"]');
        const emailInput = document.querySelector('.modals__item--whatsapp input[name="your-email"]');
        const telInput = document.querySelector('.modals__item--whatsapp input[name="your-tel"]');
        const empresaInput = document.querySelector('.modals__item--whatsapp input[name="empresa"]');

        const dataLayerEvent = {
            event: "form_whatsapp",
            nome: nomeInput?.value || "",
            email: emailInput?.value || "",
            telefone: telInput?.value || ""
        };

        if (empresaInput) {
            dataLayerEvent.empresa = empresaInput.value || "";
        }

        window.dataLayer.push(dataLayerEvent);

        wppForm.reset();

        console.log("DataLayer push:", window.dataLayer);

    }, false);

    wppFormBtn?.addEventListener('click', () => {
        if (wppFormBtn) window.open(redirect, '_blank');
    })
});

document.addEventListener("DOMContentLoaded", () => {
    const categoryMap = {
        'self-storage': 'Self Storage',
        'galpoes-flexiveis': 'Galpões flexíveis',
        'galpoes-urbanos': 'Galpões urbanos'
    };

    const matched = Object.entries(categoryMap).find(([slug]) =>
        document.body.classList.contains(`page-template-${slug}`) ||
        document.body.classList.contains(`unidades-template-single-${slug}`)
    );

    if (!matched) return;

    const [slug, targetText] = matched;

    document.querySelectorAll('input[type="radio"][name="cf_qual_o_seu_interesse_produto"]').forEach(radio => {
        const label = radio.closest('.radio-item');
        if (label && label.querySelector('.radio-content')?.textContent.trim() === targetText) {
            radio.checked = true;
        }
    });
});

document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll('input[type="radio"][name="cf_qual_o_seu_interesse_produto"]').forEach(radio => {
        radio.addEventListener('click', (e) => {
            if (e.target.value === 'UI') {
                document.querySelectorAll('input[type="radio"][name="cf_tipo_pessoa"]').forEach(item => {
                    item.checked = false;
                    const beforeLabel = item.closest('.radio-item');
                    if (item.value === "F") {
                        item.setAttribute('disabled', '')
                        beforeLabel.classList.add('block')
                    }
                });
            } else {
                document.querySelectorAll('input[type="radio"][name="cf_tipo_pessoa"]').forEach(item => {
                    item.removeAttribute('disabled')
                    const beforeLabel = item.closest('.radio-item');
                    beforeLabel.classList.remove('block')
                });
            }
        })
    });
});


document.addEventListener("DOMContentLoaded", (event) => {
    const wppFormContact = document.querySelector('.contact-form .wpcf7-form')
    wppFormContact?.addEventListener('wpcf7mailsent', function (event) {
        // wppFormContact?.addEventListener('wpcf7submit', function (event) {

        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
            event: "form_contato",
            nome: document.querySelector('.contact-form input[name="your-name"]').value || "",
            email: document.querySelector('.contact-form input[name="your-email"]').value || "",
            telefone: document.querySelector('.contact-form input[name="your-tel"]').value || "",
            unidades: document.querySelector('.contact-form select[name="unidades"]').value || "",
            como_conheceu: document.querySelector('.contact-form select[name="como-conheceu"]').value || "",
            assunto: document.querySelector('.contact-form input[name="your-subject"]').value || "",
            mensagem: document.querySelector('.contact-form textarea[name="your-message"]').value || "",
        });
        console.log("DataLayer push:", window.dataLayer);
    }, false);
});

document.addEventListener("DOMContentLoaded", (event) => {
    const wppFormNews = document.querySelector('.newsletter .wpcf7-form')
    wppFormNews?.addEventListener('wpcf7mailsent', function (event) {
        // wppFormNews?.addEventListener('wpcf7submit', function (event) {

        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
            event: "form_newsletter",
            nome: document.querySelector('.newsletter input[name="your-name"]').value || "",
            email: document.querySelector('.newsletter input[name="your-email"]').value || "",
        });
        console.log("DataLayer push:", window.dataLayer);
    }, false);
});

document.addEventListener("DOMContentLoaded", (event) => {
    let error = document.querySelector('.error-page-header__image');
    if (error) {
        bodymovin.loadAnimation({
            container: error,
            path: directoryURI + "/dist/lotties/error.json",
            render: 'svg',
            loop: true,
            autoplay: true
        })
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const closeRespose = document.querySelector('.banner-lp__form .contact-form__success-close');
    const wpcf7Elm = document.querySelector('.banner-lp__form .wpcf7-form');
    const cfSuccess = document.querySelector('.banner-lp .contact-form__success');
    const shadow = document.querySelector('.shadow');

    wpcf7Elm?.addEventListener('wpcf7mailsent', function (event) {
        cfSuccess.classList.add('active');
        shadow.classList.add('active')
    }, false);

    closeRespose?.addEventListener('click', () => {
        shadow.classList.remove('active');
        cfSuccess.classList.remove('active');
    })

    shadow.addEventListener('click', () => {
        shadow.classList.remove('active');
        cfSuccess?.classList.remove('active');
    })
});

document.addEventListener("DOMContentLoaded", function () {
    const menuLinks = document.querySelectorAll(".main-header__menu-item-link");
    const hamburguer = document.querySelector(".main-header__hamburguer");

    menuLinks.forEach(link => {
        link.addEventListener("click", function (e) {
            const href = link.getAttribute("href");

            if (href.startsWith("#") && hamburguer && window.innerWidth < 1024) {
                setTimeout(() => {
                    hamburguer.click();
                }, 300);
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", (event) => {
    const swiper = new Swiper(".slider-info__slider", {
        rewind: true,
        slidesPerView: 1,
        autoplay: {
            delay: 3500,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.slider-info__slider-next',
            prevEl: '.slider-info__slider-prev',
        },
    });
});

document.addEventListener("DOMContentLoaded", (event) => {
    const radioTipoPessoa = document.querySelectorAll('input[name="tipopessoa"]');
    const fieldConditional = document.querySelector('.field--conditional-sizes');

    if (radioTipoPessoa && fieldConditional) {
        radioTipoPessoa.forEach(element => {
            element.addEventListener('change', () => {
                if (element.value === "Sou corretor") {
                    fieldConditional.classList.add('hidden')
                } else {
                    fieldConditional.classList.remove('hidden')
                }
            })
        });
    }
});

document.addEventListener("DOMContentLoaded", (event) => {
    const floatBar = document.querySelector('.float-bar')

    floatBar?.querySelector('.float-bar__close').addEventListener('click', () => {
        floatBar.classList.add('close')
    })
});

document.addEventListener("DOMContentLoaded", (event) => {
    const selectTamanhos = document.querySelector('.banner-lp__form select[name="tamanhos"]')

    if (selectTamanhos) {
        const argsChoices = {
            maxItemCount: 3,
            loadingText: 'Carregando...',
            noResultsText: 'Sem resultados',
            noChoicesText: 'Nenhuma opção para escolher',
            itemSelectText: 'Pressione para selecionar',
            uniqueItemText: 'Apenas valores únicos podem ser adicionados',
            customAddItemText: 'Somente valores que correspondem a condições específicas podem ser adicionados',
            addItemText: (value, rawValue) => {
                return `Pressione Enter para adicionar <b>"${value}"</b>`;
            },
            removeItemIconText: () => `Remover item`,
            removeItemLabelText: (value, rawValue) => `Remover item: ${value}`,
            maxItemText: (maxItemCount) => {
                return `Apenas ${maxItemCount} ite${maxItemCount > 1 ? 'ns' : 'm'} pode${maxItemCount > 1 ? 'm' : ''} ser adicionado${maxItemCount > 1 ? 's' : ''}`;
            },
            sorter: () => { }
        }
        let choices = new Choices(selectTamanhos, argsChoices);
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const argsChoices = {
        loadingText: 'Carregando...',
        noResultsText: 'Sem resultados',
        noChoicesText: 'Nenhuma opção para escolher',
        itemSelectText: '',
        uniqueItemText: 'Apenas valores únicos podem ser adicionados',
        customAddItemText: 'Somente valores que correspondem a condições específicas podem ser adicionados',
        addItemText: (value, rawValue) => {
            return `Pressione Enter para adicionar <b>"${value}"</b>`;
        },
        removeItemIconText: () => `Remover item`,
        removeItemLabelText: (value, rawValue) => `Remover item: ${value}`,
        maxItemText: (maxItemCount) => {
            return `Apenas ${maxItemCount} ite${maxItemCount > 1 ? 'ns' : 'm'} pode${maxItemCount > 1 ? 'm' : ''} ser adicionado${maxItemCount > 1 ? 's' : ''}`;
        },
        sorter: () => { }
    }

    fetch(homeURL + '/wp-json/gs/v1/dados-formulario')
        .then(res => res.json())
        .then(data => {
            // Preenche unidades
            const selectUnidades = document.querySelector('.contact-form__form select[name="unidades"]');
            if (selectUnidades && data.unidades) {
                Object.entries(data.unidades).forEach((item, index) => {
                    const option = document.createElement('option');
                    option.value = item[0];
                    option.textContent = item[1].nome;
                    selectUnidades.appendChild(option);
                });
                let choices = new Choices('.contact-form__form select[name="unidades"]', argsChoices);
            }
        })
        .catch(err => {
            console.error('Erro ao buscar dados do formulário:', err);
        });
});

document.addEventListener("DOMContentLoaded", function () {
    const modalCategories = document.querySelector('.blog-controls__select');

    if (modalCategories) {
        modalCategories.addEventListener('click', () => {
            modalCategories?.querySelector('.blog-controls__select-dropdown').classList.toggle('active');
        })
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const forms = document.querySelectorAll('form');

    forms.forEach((form) => {
        const submitBtn = form.querySelector('input[type="submit"], button[type="submit"]');
        if (!submitBtn) return;

        submitBtn.addEventListener('click', async function (e) {
            e.preventDefault();
            e.stopPropagation();

            const emailInput = form.querySelector('input[type="email"]');
            if (!emailInput) return;

            const email = emailInput.value.trim();

            const valido = await validarEmailNaAPI(email);
            if (!valido) {
                alert("O e-mail não é válido ou confiável.");
                if (form.classList.contains('modals__item-form')) {
                    const steps = document.querySelectorAll(".step");
                    steps[0].classList.add('active');
                    const progress = document.querySelectorAll(".progress");
                    progress.forEach(el => el.classList.remove('active'));
                    progress[0].classList.add('active');
                    currentStep = 0;
                    // stepIndex = 0;
                    document.querySelector("#form-orcamento")?.reset();

                    document.querySelector(".step--error")?.classList.remove('active');
                    document.querySelector(".step--end")?.classList.remove('active');
                }
                return;
            }

            form.dispatchEvent(new Event('submit', { bubbles: true, cancelable: true }));
        });
    });
});

// Função assíncrona que verifica e-mail usando uma API externa
async function validarEmailNaAPI(email) {
    const apiKey = "7b3a6dd0403148e5be41b59df5f5113f";
    const apiUrl = `https://emailvalidation.abstractapi.com/v1/?api_key=${apiKey}&email=${encodeURIComponent(email)}`;

    try {
        const resposta = await fetch(apiUrl);
        if (!resposta.ok) throw new Error("Erro na requisição");

        const dados = await resposta.json();
        return dados.deliverability === "DELIVERABLE";
    } catch (erro) {
        console.error("Erro durante a validação do e-mail:", erro);
        return false;
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const toHiddenField = document.querySelectorAll('.to-hidden input')
    const theHiddenField = document.querySelector('input.the-hidden')

    if (!toHiddenField) return;

    toHiddenField?.forEach(element => {
        element.addEventListener('change', (e) => {
            if(theHiddenField) theHiddenField.value = e.target.value
        })
    })
});
