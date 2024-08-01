/*=============== EXPANDED LIST ===============*/
const navExpand = document.getElementById('nav-expand'),
      navExpandList = document.getElementById('nav-expand-list'),
      navExpandIcon = document.getElementById('nav-expand-icon')

navExpand.addEventListener('click', () => {
   // Expand list
   navExpandList.classList.toggle('show-list')

   // Rotate icon
   navExpandIcon.classList.toggle('rotate-icon')
})

/*=============== SCROLL SECTIONS ACTIVE LINK ===============*/
const sections = document.querySelectorAll('section[id]')

const scrollActive = () =>{
  	const scrollDown = window.scrollY

	sections.forEach(current =>{
		const sectionHeight = current.offsetHeight,
			  sectionTop = current.offsetTop - 58,
			  sectionId = current.getAttribute('id'),
			  sectionsClass = document.querySelector('.nav__list a[href*=' + sectionId + ']')

		if(scrollDown > sectionTop && scrollDown <= sectionTop + sectionHeight){
			sectionsClass.classList.add('active-link')
		}else{
			sectionsClass.classList.remove('active-link')
		}
	})
}
window.addEventListener('scroll', scrollActive)


// POPUP
let popupBg = document.querySelector('.popup__bg');
let popup = document.querySelector('.popup');
let popupName = document.getElementById('popup_name');
let popupPhone = document.getElementById('popup_phone');
let popupAddress = document.getElementById('popup_address');



function openPopup(task) {
    popupBg.classList.add('active');
    popup.classList.add('active');
    popupName.innerText = task.client.name
    popupPhone.innerText = task.client.phone
    popupAddress.innerText = task.point.address
}

function closePopup() {
    popupBg.classList.remove('active');
    popup.classList.remove('active');
    popupName.innerText = ""
    popupPhone.innerText = ""
    popupAddress.innerText = ""
}
