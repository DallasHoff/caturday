<style>
.card-gallery {
	display: grid;
	grid-template-columns: 1fr;
	grid-column-gap: 1rem;
	grid-row-gap: 1rem;
	list-style-type: none;
	margin: 1rem 0 4rem 0;
	padding: 0;
}


@media (min-width: 540px) {

    .card-gallery {
        grid-template-columns: repeat(2, 1fr);
    }

}
</style>