let calendars = document.querySelectorAll('.cal')
console.log(calendars)
calendars.forEach(calendar => {
    calendar.addEventListener('mouseover', () => {
        calendar.style.scale = '1.2';
        calendar.style.zIndex = '4';
    });
    calendar.addEventListener('mouseout', () => {
        calendar.style.scale = '1';
        calendar.style.zIndex = '0';
        calendar.style.color = 'black';
    });
});

