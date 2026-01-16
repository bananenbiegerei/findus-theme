// Tailwind v4 default breakpoints
const screens = {
	sm: '640px',
	md: '768px',
	lg: '1024px',
	xl: '1280px',
	'2xl': '1536px',
};

export const getBreakpointValue = (bpName) => {
	if (bpName == '' || typeof bpName == 'undefined') {
		return 0;
	} else {
		let bpValue = screens[bpName];
		if (!bpValue) return 0;
		bpValue = bpValue.slice(0, bpValue.indexOf('px'));
		return parseInt(bpValue);
	}
};

export const getCurrentBreakpoint = (width) => {
	let currentBreakpoint = '';
	let biggestBreakpointValue = 0;

	for (const breakpoint of Object.keys(screens)) {
		const breakpointValue = getBreakpointValue(breakpoint);
		if (breakpointValue > biggestBreakpointValue && window.innerWidth >= breakpointValue) {
			biggestBreakpointValue = breakpointValue;
			currentBreakpoint = breakpoint;
		}
	}

	return currentBreakpoint;
};

export const isMinBreakpoint = (width, bpName) => {
	return width >= getBreakpointValue(bpName);
};
