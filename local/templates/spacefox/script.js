(function () {
    const favoritesKey = "spacefox-favorites";

    function readFavorites() {
        try {
            const parsed = JSON.parse(localStorage.getItem(favoritesKey) || "[]");
            return Array.isArray(parsed) ? parsed : [];
        } catch (error) {
            return [];
        }
    }

    function writeFavorites(items) {
        localStorage.setItem(favoritesKey, JSON.stringify(items));
        paintFavorites();
    }

    function paintFavorites() {
        const items = readFavorites();
        document.querySelectorAll("[data-fav]").forEach(function (button) {
            button.classList.toggle("is-active", items.indexOf(button.dataset.fav) !== -1);
        });
        const counter = document.querySelector("[data-fav-count]");
        if (!counter) {
            return;
        }
        counter.hidden = items.length === 0;
        counter.textContent = String(items.length);
    }

    function plural(number, one, few, many) {
        const abs = Math.abs(number) % 100;
        const tail = abs % 10;
        if (abs > 10 && abs < 20) {
            return many;
        }
        if (tail > 1 && tail < 5) {
            return few;
        }
        if (tail === 1) {
            return one;
        }
        return many;
    }

    document.querySelectorAll("[data-dropdown]").forEach(function (button) {
        button.addEventListener("click", function (event) {
            event.stopPropagation();
            const menu = document.querySelector('[data-menu="' + button.dataset.dropdown + '"]');
            const willOpen = !menu.classList.contains("is-open");
            document.querySelectorAll("[data-menu]").forEach(function (node) {
                node.classList.remove("is-open");
            });
            document.querySelectorAll("[data-dropdown]").forEach(function (node) {
                node.setAttribute("aria-expanded", "false");
            });
            menu.classList.toggle("is-open", willOpen);
            button.setAttribute("aria-expanded", willOpen ? "true" : "false");
        });
    });

    document.addEventListener("click", function () {
        document.querySelectorAll("[data-menu], .sf-pick-menu").forEach(function (node) {
            node.classList.remove("is-open");
        });
    });

    const burger = document.querySelector("[data-burger]");
    const nav = document.querySelector("[data-nav]");
    if (burger && nav) {
        burger.addEventListener("click", function () {
            const open = nav.classList.toggle("is-open");
            burger.setAttribute("aria-expanded", open ? "true" : "false");
        });
    }

    const slides = Array.prototype.slice.call(document.querySelectorAll("[data-hero-slide]"));
    const heroIndex = document.querySelector("[data-hero-index]");
    let slideCursor = 0;

    function showSlide(index) {
        if (!slides.length) {
            return;
        }
        slideCursor = (index + slides.length) % slides.length;
        slides.forEach(function (slide, slideIndex) {
            slide.classList.toggle("is-active", slideIndex === slideCursor);
        });
        if (heroIndex) {
            heroIndex.textContent = String(slideCursor + 1);
        }
    }

    document.querySelectorAll("[data-hero-go]").forEach(function (button) {
        button.addEventListener("click", function () {
            showSlide(slideCursor + Number(button.dataset.heroGo));
        });
    });

    if (slides.length > 1) {
        window.setInterval(function () {
            showSlide(slideCursor + 1);
        }, 7000);
    }

    function openModal(id) {
        const modal = document.getElementById(id);
        if (!modal) {
            return;
        }
        modal.hidden = false;
        const focusable = modal.querySelector("input, button");
        if (focusable) {
            focusable.focus();
        }
    }

    function closeModal(modal) {
        modal.hidden = true;
        const form = modal.querySelector("form");
        const success = modal.querySelector(".sf-modal__success");
        if (form) {
            form.hidden = false;
        }
        if (success) {
            success.hidden = true;
        }
    }

    document.querySelectorAll("[data-close]").forEach(function (node) {
        node.addEventListener("click", function () {
            const modal = node.closest(".sf-modal");
            if (modal) {
                closeModal(modal);
            }
        });
    });

    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            document.querySelectorAll(".sf-modal").forEach(function (modal) {
                if (!modal.hidden) {
                    closeModal(modal);
                }
            });
        }
    });

    const callbackFlat = document.querySelector("[data-callback-flat]");
    document.querySelectorAll("[data-callback]").forEach(function (button) {
        button.addEventListener("click", function () {
            const flatName = button.dataset.flat || "";
            if (callbackFlat) {
                callbackFlat.hidden = flatName === "";
                callbackFlat.textContent = flatName ? "Квартира: " + flatName : "";
            }
            openModal("sf-callback");
        });
    });

    const callbackForm = document.getElementById("sf-callback-form");
    if (callbackForm) {
        callbackForm.addEventListener("submit", function (event) {
            event.preventDefault();
            callbackForm.hidden = true;
            const success = callbackForm.parentElement.querySelector(".sf-modal__success");
            if (success) {
                success.hidden = false;
            }
            callbackForm.reset();
        });
    }

    document.querySelectorAll("[data-map-open]").forEach(function (button) {
        button.addEventListener("click", function () {
            openModal("sf-map");
        });
    });

    const catalog = document.querySelector("[data-catalog]");
    if (catalog) {
        const cards = Array.prototype.slice.call(catalog.querySelectorAll("[data-card]"));
        const roomButtons = catalog.querySelectorAll("[data-rooms]");
        const priceMin = catalog.querySelector("[data-price-min]");
        const priceMax = catalog.querySelector("[data-price-max]");
        const priceMinLabel = catalog.querySelector("[data-price-min-label]");
        const priceMaxLabel = catalog.querySelector("[data-price-max-label]");
        const deadline = catalog.querySelector("[data-deadline]");
        const complex = catalog.querySelector("[data-complex]");
        const finishing = catalog.querySelector("[data-finishing]");
        const district = catalog.querySelector("[data-district]");
        const areaMin = catalog.querySelector("[data-area-min]");
        const areaMax = catalog.querySelector("[data-area-max]");
        const countButton = catalog.querySelector("[data-count]");
        const empty = catalog.querySelector("[data-empty]");
        const grid = catalog.querySelector("[data-grid]");
        const more = catalog.querySelector("[data-more]");
        const commerce = catalog.querySelector("[data-commerce]");
        const params = new URLSearchParams(window.location.search);
        let favoritesOnly = params.get("favorites") === "1";

        function selectedRooms() {
            return Array.prototype.map.call(
                catalog.querySelectorAll("[data-rooms].is-active"),
                function (button) {
                    return button.dataset.rooms;
                }
            );
        }

        function formatMillion(value) {
            return String(value).replace(".", ",");
        }

        function applyFilters() {
            const rooms = selectedRooms();
            const minPrice = Number(priceMin.value);
            const maxPrice = Number(priceMax.value);
            const visibleMode = catalog.dataset.mode || "flats";
            let visible = 0;

            cards.forEach(function (card) {
                const price = Number(card.dataset.price) / 1000000;
                const area = Number(card.dataset.area);
                const favoriteOk = !favoritesOnly || readFavorites().indexOf(card.dataset.code) !== -1;
                const roomOk = rooms.length === 0 || rooms.some(function (room) {
                    if (room === "4") {
                        return Number(card.dataset.rooms) >= 4;
                    }
                    return card.dataset.rooms === room;
                });
                const priceOk = price >= minPrice - 0.05 && price <= maxPrice + 0.05;
                const deadlineOk = !deadline.value || card.dataset.deadline === deadline.value;
                const complexOk = !complex.value || card.dataset.complex === complex.value;
                const finishingOk = !finishing.value || card.dataset.finishing === finishing.value;
                const districtOk = !district.value || card.dataset.district === district.value;
                const areaMinOk = !areaMin.value || area >= Number(areaMin.value);
                const areaMaxOk = !areaMax.value || area <= Number(areaMax.value);
                const show = visibleMode === "flats" && favoriteOk && roomOk && priceOk && deadlineOk && complexOk && finishingOk && districtOk && areaMinOk && areaMaxOk;
                card.classList.toggle("is-hidden", !show);
                if (show) {
                    visible += 1;
                }
            });

            if (priceMinLabel) {
                priceMinLabel.textContent = formatMillion(Number(priceMin.value).toFixed(1));
            }
            if (priceMaxLabel) {
                priceMaxLabel.textContent = formatMillion(Number(priceMax.value).toFixed(1));
            }
            if (countButton) {
                countButton.textContent = visible + " " + plural(visible, "квартира", "квартиры", "квартир");
            }
            if (empty) {
                empty.hidden = visible !== 0 || visibleMode !== "flats";
            }
            if (grid) {
                grid.hidden = visibleMode !== "flats";
            }
            if (commerce) {
                commerce.classList.toggle("is-open", visibleMode === "commerce");
            }
        }

        roomButtons.forEach(function (button) {
            button.addEventListener("click", function () {
                button.classList.toggle("is-active");
                applyFilters();
            });
        });

        [priceMin, priceMax].forEach(function (input) {
            input.addEventListener("input", function () {
                if (Number(priceMin.value) > Number(priceMax.value)) {
                    if (input === priceMin) {
                        priceMax.value = priceMin.value;
                    } else {
                        priceMin.value = priceMax.value;
                    }
                }
                applyFilters();
            });
        });

        [deadline, complex, finishing, district, areaMin, areaMax].forEach(function (input) {
            input.addEventListener("input", applyFilters);
            input.addEventListener("change", applyFilters);
        });

        catalog.querySelectorAll("[data-reset]").forEach(function (reset) {
            reset.addEventListener("click", function () {
                roomButtons.forEach(function (button) {
                    button.classList.remove("is-active");
                });
                priceMin.value = priceMin.min;
                priceMax.value = priceMax.max;
                deadline.value = "";
                complex.value = "";
                finishing.value = "";
                district.value = "";
                areaMin.value = "";
                areaMax.value = "";
                favoritesOnly = false;
                catalog.dataset.mode = "flats";
                applyFilters();
            });
        });

        const moreButton = catalog.querySelector("[data-more-toggle]");
        if (moreButton && more) {
            moreButton.addEventListener("click", function () {
                const open = more.classList.toggle("is-open");
                moreButton.setAttribute("aria-expanded", open ? "true" : "false");
            });
        }

        const pick = catalog.querySelector("[data-pick]");
        const pickMenu = catalog.querySelector("[data-pick-menu]");
        if (pick && pickMenu) {
            pick.addEventListener("click", function (event) {
                event.stopPropagation();
                pickMenu.classList.toggle("is-open");
            });
            pickMenu.querySelectorAll("[data-mode]").forEach(function (button) {
                button.addEventListener("click", function () {
                    catalog.dataset.mode = button.dataset.mode;
                    pick.textContent = button.dataset.label;
                    pickMenu.querySelectorAll("button").forEach(function (node) {
                        node.classList.toggle("is-active", node === button);
                    });
                    pickMenu.classList.remove("is-open");
                    applyFilters();
                });
            });
        }

        if (params.get("rooms")) {
            params.get("rooms").split(",").forEach(function (room) {
                const button = catalog.querySelector('[data-rooms="' + room + '"]');
                if (button) {
                    button.classList.add("is-active");
                }
            });
        }
        if (params.get("complex") && complex) {
            complex.value = params.get("complex");
        }
        if (params.get("deadline") && deadline) {
            deadline.value = params.get("deadline");
        }
        if (params.get("finishing") && finishing) {
            finishing.value = params.get("finishing");
        }
        if (params.get("district") && district) {
            district.value = params.get("district");
        }
        if (favoritesOnly && more) {
            more.classList.add("is-open");
        }

        applyFilters();
    }

    document.querySelectorAll("[data-fav]").forEach(function (button) {
        button.addEventListener("click", function () {
            const items = readFavorites();
            const code = button.dataset.fav;
            const index = items.indexOf(code);
            if (index === -1) {
                items.push(code);
            } else {
                items.splice(index, 1);
            }
            writeFavorites(items);
            if (catalog && new URLSearchParams(window.location.search).get("favorites") === "1") {
                const event = new Event("change");
                const complex = catalog.querySelector("[data-complex]");
                if (complex) {
                    complex.dispatchEvent(event);
                }
            }
        });
    });

    const favoritesLink = document.querySelector("[data-favorites-link]");
    if (favoritesLink) {
        favoritesLink.addEventListener("click", function () {
            if (document.querySelector("[data-catalog]")) {
                const url = new URL(window.location.href);
                url.searchParams.set("favorites", "1");
                url.hash = "catalog";
                window.location.href = url.pathname + "?" + url.searchParams.toString() + "#catalog";
                return;
            }
            window.location.href = "/?favorites=1#catalog";
        });
    }

    const newsRoot = document.querySelector("[data-news]");
    if (newsRoot) {
        const newsParams = new URLSearchParams(window.location.search);
        const cards = newsRoot.querySelectorAll("[data-news-card]");
        const search = newsRoot.querySelector("[data-news-search]");
        const complex = newsRoot.querySelector("[data-news-complex]");
        const tags = newsRoot.querySelectorAll("[data-news-tag]");
        let activeTag = newsParams.get("tag") || "";

        function applyNews() {
            const query = (search.value || "").trim().toLowerCase();
            let visible = 0;
            cards.forEach(function (card) {
                const text = (card.dataset.text || "").toLowerCase();
                const tagOk = !activeTag || card.dataset.tag === activeTag;
                const complexOk = !complex.value || card.dataset.complex === complex.value;
                const searchOk = !query || text.indexOf(query) !== -1;
                const show = tagOk && complexOk && searchOk;
                card.classList.toggle("is-hidden", !show);
                if (show) {
                    visible += 1;
                }
            });
            const empty = newsRoot.querySelector("[data-news-empty]");
            if (empty) {
                empty.hidden = visible !== 0;
            }
        }

        tags.forEach(function (button) {
            button.classList.toggle("is-active", button.dataset.newsTag === activeTag);
            button.addEventListener("click", function () {
                activeTag = button.dataset.newsTag;
                tags.forEach(function (node) {
                    node.classList.toggle("is-active", node === button);
                });
                applyNews();
            });
        });
        search.addEventListener("input", applyNews);
        complex.addEventListener("change", applyNews);
        applyNews();
    }

    const detail = document.querySelector("[data-detail]");
    if (detail) {
        const views = detail.querySelectorAll("[data-view]");
        detail.querySelectorAll("[data-show]").forEach(function (button) {
            button.addEventListener("click", function () {
                detail.querySelectorAll("[data-show]").forEach(function (node) {
                    node.classList.toggle("is-active", node === button);
                });
                views.forEach(function (view) {
                    view.hidden = view.dataset.view !== button.dataset.show;
                });
                const heading = detail.querySelector("[data-stage-title]");
                if (heading) {
                    heading.textContent = button.dataset.show === "floor" ? "Этаж" : "Планировка";
                }
            });
        });
        const printButton = detail.querySelector("[data-print]");
        if (printButton) {
            printButton.addEventListener("click", function () {
                window.print();
            });
        }
    }

    paintFavorites();
})();
