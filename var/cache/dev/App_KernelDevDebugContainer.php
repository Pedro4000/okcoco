<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerAEE1vOy\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerAEE1vOy/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerAEE1vOy.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerAEE1vOy\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerAEE1vOy\App_KernelDevDebugContainer([
    'container.build_hash' => 'AEE1vOy',
    'container.build_id' => 'c181f934',
    'container.build_time' => 1612876653,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerAEE1vOy');
