const NAMES = [
	"Alpha",
	"Beta",
	"Gamma",
	"Delta",
	"Epsilon",
	"Zeta",
	"Eta",
	"Theta",
	"Iota",
	"Kappa",
	"Lambda",
	"Mu",
	"Nu",
	"Xi",
	"Omikron",
	"Pi",
	"Rho",
	"Sigma",
	"Tau",
	"Upsilon",
	"Phi",
	"Chi",
	"Psi",
	"Omega"
];

const COLORS = [ 
	"red", 
	"green",
	"blue",
	"magenta",
	"plum",
	"orange",
	"fuchsia"
].sort((a, b) => Math.random() > 0.5);


class User {
	constructor(index, connection) {
		this.name = NAMES[index % NAMES.length];
		this.color = COLORS[index % COLORS.length];
		this.index = index;
		this.connection = connection;
	}
}

module.exports = User;