const testimonialContainer = document.querySelector('.testimonial-container')
const testimonial = document.querySelector('.testimonial-text')
const username = document.querySelector('.testimonial-user')

const testimonials = [
  {
    name: 'John Doe in <cite title="Twitter">Twitter</cite>',
    text:
      "Aenean tincidunt libero nec ipsum placerat, ac condimentum ante ullamcorper. Praesent libero velit, mollis at justo eget, feugiat aliquet nisi.",
  },
  {
    name: 'Mary Ann in <cite title="Facebook">Facebook</cite>',
    text:
      'Etiam efficitur convallis urna, nec scelerisque augue tincidunt ac. Sed quis elit fermentum, accumsan eros id, lobortis purus. ',
  },
  {
    name: 'Tom Dale in <cite title="Instagram">Instagram</cite>',
    text:
      "Pellentesque eu dolor sit amet nunc faucibus laoreet ullamcorper at odio. Duis ultrices nisl nec arcu consectetur luctus.. ",
  },
]

let idx = 1

function updateTestimonial() {
  const { name, text } = testimonials[idx]

  testimonial.innerHTML = text
  username.innerHTML = name

  idx++

  if (idx > testimonials.length - 1) {
    idx = 0
  }
}

setInterval(updateTestimonial, 3000)





