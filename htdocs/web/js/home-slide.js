$(".post-media").each(function () {

    let isDown = false;
    let startX;
    let scrollLeft;

    this.addEventListener("mousedown", (e) => {
        isDown = true;
        this.classList.add("active");
        startX = e.pageX - this.offsetLeft;
        scrollLeft = this.scrollLeft;
    });
    this.addEventListener("mouseleave", () => {
        isDown = false;
        this.classList.remove("active");
    });
    this.addEventListener("mouseup", () => {
        isDown = false;
        this.classList.remove("active");
    });
    this.addEventListener("mousemove", (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - this.offsetLeft;
        const walk = (x - startX) * 3; //scroll-fast
        this.scrollLeft = scrollLeft - walk;
    });
});