const sliderContainer = document.querySelector('.slider-container');
    const sliderItems = document.querySelectorAll('.slider-item');
    const prevButton = document.querySelector('.arrow.left');
    const nextButton = document.querySelector('.arrow.right');

    let currentIndex = 0;
    const totalItems = 10;

    function updateSliderPosition() {
      sliderContainer.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    function moveToNextSlide() {
      if (currentIndex === totalItems - 1) {
        currentIndex = 0;
      } else {
        currentIndex += 1;
      }
      updateSliderPosition();
    }

    function moveToPrevSlide() {
      if (currentIndex === 0) {
        currentIndex = totalItems - 1;
      } else {
        currentIndex -= 1;
      }
      updateSliderPosition();
    }

    nextButton.addEventListener('click', moveToNextSlide);
    prevButton.addEventListener('click', moveToPrevSlide);

    setInterval(moveToNextSlide, 3000);