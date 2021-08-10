<style>
.gallery-card {
	background-color: var(--background4);
	border-radius: var(--border-radius1);
	box-shadow: var(--material-shadow1);
	transition: box-shadow .3s;
	overflow: hidden;
}
.gallery-card:hover {
	box-shadow: var(--material-shadow2);
}
.gallery-card__link {
	display: block;
	text-decoration: none;
}
.gallery-card__figure {
	position: relative;
	max-height: 40vh;
	background-color: var(--background1);
	overflow: hidden;
}
.gallery-card__image {
	display: block;
	width: 100%;
	height: auto;
}
.gallery-card__body {
	padding: 1rem;
}
.gallery-card__author {
	font-size: .7em;
	margin: .8rem 0;
	color: var(--text3);
}
.gallery-card__heading a,
.gallery-card__author a {
	color: inherit;
}
.gallery-card__description {
	font-size: .9em;
	margin: .8rem 0;
	color: var(--text2);
}


@media (min-width: 540px) {

	.gallery-card__figure {
		height: 30vw;
		max-height: 15rem;
	}
	.gallery-card__image {
		position: absolute;
		top: 50%;
		transform: translateY(-50%);
		width: 100%;
		height: auto;
	}

	@supports (object-fit: cover) {
		.gallery-card__image {
			object-fit: cover;
			height: 100%;
        }
	}

}
</style>