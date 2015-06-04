<?php
$container = new \King23\DI\DependencyContainer();

// the output writer
$container->register(
    \Knight23\Core\Output\WriterInterface::class,
    function () use ($container) {
        return $container->getInstanceOf(\Knight23\Core\Output\ColoredTextWriter::class);
    }
);

// the default theme
$container->register(
    \Knight23\Core\Colors\SimpleReplaceThemeInterface::class,
    function () {
        return new \Knight23\Core\Colors\SimpleReplaceTheme();
    }
);


// the react event loop - this uses the factory by default - which should allow it to run on most
// php enabled systems
$container->register(
    \React\EventLoop\LoopInterface::class,
    function () {
        return \React\EventLoop\Factory::create();
    }
);

// register a banner class - allows easy override for own banners
$container->register(
    \Knight23\Core\Banner\BannerInterface::class,
    function () use ($container) {
        return $container->getInstanceOf(\Pharckager\Banner::class);
    }
);


// register the main application itself
$container->register(
    \Knight23\Core\RunnerInterface::class,
    function () use ($container) {
        // instance for the class
        return $container->getInstanceOf(\Knight23\Core\Knight23::class);
    }
);


return $container;
