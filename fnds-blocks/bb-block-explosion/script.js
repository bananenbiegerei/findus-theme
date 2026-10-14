document.querySelectorAll('.bb-block-explosion').forEach((block) => {
	const images = Array.from(block.querySelectorAll('.explosion-image'));
	if (!images.length) return;

	const { gsap } = window;
	const totalImages = images.length;

	// Pinning is handled via CSS position:sticky — GSAP only drives the image animations

	// Pre-compute deterministic offsets so layout is consistent (no Math.random)
	// Images come in from evenly distributed angles around the viewport
	// Description elements keyed by data-index
	const descs = {};
	block.querySelectorAll('.explosion-description').forEach((el) => {
		descs[el.dataset.index] = el;
	});

	// First image starts fully visible, its description too
	gsap.set(images[0], { opacity: 1, x: 0, y: 0, rotation: 0, scale: 1 });
	if (descs[0]) gsap.set(descs[0], { opacity: 1 });

	// Remaining images to animate (all except the first)
	const animatedImages = images.slice(1);
	const animatedCount = animatedImages.length;

	animatedImages.forEach((img, j) => {
		const i = j + 1; // original index for angle calculation
		const angle = (i / totalImages) * Math.PI * 2 - Math.PI / 2; // start from top
		const fromX = Math.cos(angle) * 60; // vw units
		const fromY = Math.sin(angle) * 60; // vh units
		const fromRotation = ((i % 2 === 0 ? 1 : -1) * (10 + (i * 7) % 15));

		// Distribute animations evenly across first 66% of scroll
		const animationRange = 66;
		const segmentStart = (j / animatedCount) * animationRange;
		const segmentEnd = ((j + 0.8) / animatedCount) * animationRange;

		const scrollTriggerConfig = {
			trigger: block,
			start: `top+=${segmentStart}% top`,
			end: `top+=${segmentEnd}% top`,
			scrub: 0.8,
		};

		gsap.fromTo(
			img,
			{ opacity: 0, x: fromX + 'vw', y: fromY + 'vh', rotation: fromRotation, scale: 0.5 },
			{ opacity: 1, x: '0vw', y: '0vh', rotation: 0, scale: 1, ease: 'power3.out', scrollTrigger: scrollTriggerConfig }
		);

		if (descs[i]) {
			gsap.fromTo(
				descs[i],
				{ opacity: 0 },
				{ opacity: 1, ease: 'power2.out', scrollTrigger: scrollTriggerConfig }
			);
		}
	});
});
