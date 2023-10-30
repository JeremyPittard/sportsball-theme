window.onload = () => {
  const swup = new Swup({
    plugins: [
      new SwupProgressPlugin(),
      new SwupScrollPlugin({
        animateScroll: {
          betweenPages: false,
          samePageWithHash: false,
          samePage: false,
        },
      }),
    ],
  });
};
