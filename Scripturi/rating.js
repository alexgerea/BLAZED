const starWrapper = document.querySelector(".stars");
const stars = document.querySelectorAll(".stars a");

var starrating;

stars.forEach((star, clickedIdx) => {
    star.addEventListener("click", () => {
        starWrapper.classList.add("disabled");
        stars.forEach((otherStar,otherIdx) => {
            if(otherIdx <= clickedIdx){
                otherStar.classList.add("active");
            }
        });
        starrating=clickedIdx+1;
    });
});

function setrating(){
    if(starrating == undefined)
    {
        return "Nu a fost ales";
    }
    return starrating;
}