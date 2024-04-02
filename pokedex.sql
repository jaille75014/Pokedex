CREATE TABLE `pokemons` (
  `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(128),
  `pv` INTEGER,
  `attack` INTEGER,
  `defense` INTEGER,
  `speed` INTEGER,
  `image` varchar(128),
  `id_user` INTEGER REFERENCES users(id)
);

CREATE TABLE `users` (
  `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `pseudo` varchar(60),
  `email` varchar(128),
  `password` varchar(128),
  `image` varchar(128)
);

INSERT INTO `users` (`id`, `pseudo`, `email`, `password`, `image`) VALUES
(1, 'test', 'test@test.com', '8020d1a33b77f2fbcb83d897ffdfbc5f6961a70952501a9d188d4c51fbc5caea', 'default.svg'),
(2, 'sacha', 'sacha@gmail.com', '5a45b8c84b1913b4fb524660e709d1b81d694a028d2516297b0da4c259acbf7f', 'default.svg'),
(3, 'mike', 'mike@gmail.com', '2f387d65802ef43966c601a4df111587df9782f8ce8cc8f7e8fa20bfd8a422f9', 'default.svg'),
(4, 'Snow', 'snow@gmail.com', 'f67a0bec7a089d9f0c49621644be71f87ea24a23d1b66ed6bbb80818fe0f0bcc', 'default.svg');