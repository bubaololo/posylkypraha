





var swiper = new Swiper(".mySwiper", {
  pagination: {
    el: ".quest__slider_bar_wrapper",
    type: "bullets",
    currentClass: "quest__slider_dot",
    progressbarFillClass: ".swiper-pagination-bullet-active",
  },
    preventClicks: false,
    preventClicksPropagation: false,
    simulateTouch: false,
  navigation: {
    nextEl: ".quest__next",
    prevEl: ".quest__prev",
  },
  effect: "fade",
  allowTouchMove: false,
  allowSlideNext: false,
});

const bar = document.querySelector(".quest__slider_bar_wrapper");
if (bar) {

    const bullets = bar.children;

    bullets[1].classList.add("bullet_next_next");

    function findActiveBullet(collection) {
        for (var i = 0; i < collection.length; i++) {
            if (collection[i].classList.contains("swiper-pagination-bullet-active")) {
                return i;
            }
        }
        return false;
    }

    function removeAdditionClasses(collection) {
        for (var i = 0; i < collection.length; i++) {

            if (collection[i].classList.contains("bullet_next_next")) {
                collection[i].classList.remove("bullet_next_next");
            } else if (collection[i].classList.contains("bullet_checked")) {
                collection[i].classList.remove("bullet_checked");
            }
        }
    }

    function findChecked(collection, currentBullet) {
        for (var i = 0; i < currentBullet; i++) {
            collection[i].classList.add("bullet_checked");
        }
    }

    const target = document.querySelector(".quest__slider_bar_wrapper");

    const observer = new MutationObserver(function (mutations) {
        mutations.forEach(function (mutation) {
            let currentBullet = findActiveBullet(bullets);
            removeAdditionClasses(bullets);
            findChecked(bullets, currentBullet);
            if (bullets[currentBullet + 1] !== undefined) {
                bullets[currentBullet + 1].classList.add("bullet_next_next");
            }
        });
    });

    const config = {attributes: true, childList: true, characterData: true};

    observer.observe(target, config);

    const successMessage = document.querySelector('.quest .success');

}

const checkbox = document.getElementById('registerCheck');
const passwordGroup = document.getElementById('password-group');

if(checkbox) {
  checkbox.addEventListener('change', function() {
    if (this.checked) {
      passwordGroup.classList.remove('quest__input-group_hidden');
    } else {
      passwordGroup.classList.add('quest__input-group_hidden');
    }
  });
}





    // const form = document.getElementById('quest_form');
    // form.addEventListener('submit', function (e) {
    //     e.preventDefault();
    //     console.log(new FormData(form))
    //     fetch("/checkout", {
    //         method: "POST",
    //         headers: {
    //             "Content-Type": "application/json",
    //             Accept: "application/json",
    //             "X-Requested-With": "XMLHttpRequest",
    //             "X-CSRF-TOKEN": document.head.querySelector("meta[name=csrf-token]")
    //                 .content,
    //         },
    //         credentials: "same-origin",
    //         body: new FormData(form),
    //     })
    //         .then((response) => {
    //             return response;
    //         })
    //         .then((data) => {
    //             alert('заказ оформлен');
    //         });
    // });





// function send(event) {
//         event.preventDefault();
//         sendFormData();
//         alert('заказ оформлен');
//   // successMessage.classList.add('active');
// }
// }




