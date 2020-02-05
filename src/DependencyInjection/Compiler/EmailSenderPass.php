<?php
namespace App\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

use App\Domain\EmailSender;

class EmailSenderPass implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has(EmailSender::class)) {
            return;
        }

        $definition = $container->findDefinition(EmailSender::class);

        $taggedBeforeSendInterceptors = $container->findTaggedServiceIds('app.email_sender_interceptor.before');
        $taggedBeforeSendInterceptors = $this->sortTaggedInterceptorsByPriority($taggedBeforeSendInterceptors);
        foreach ($taggedBeforeSendInterceptors as $id => $tags) {
            $definition->addMethodCall('addBeforeSendInterceptor', [new Reference($id)]);
        }

        $taggedAfterSendInterceptors = $container->findTaggedServiceIds('app.email_sender_interceptor.after');
        $taggedAfterSendInterceptors = $this->sortTaggedInterceptorsByPriority($taggedAfterSendInterceptors);
        foreach ($taggedAfterSendInterceptors as $id => $tags) {
            $definition->addMethodCall('addAfterSendInterceptor', [new Reference($id)]);
        }
    }

    /**
     * @param array $taggedInterceptors
     *
     * @return array
     */
    private function sortTaggedInterceptorsByPriority(array $taggedInterceptors): array
    {
        $getPriority = function (array $tags) {
            foreach ($tags as $tag) {
                if (array_key_exists('priority', $tag)) {
                    return $tag['priority'];
                }
            }

            return null;
        };

        uasort($taggedInterceptors, function ($aTags, $bTags) use ($getPriority) {
            $aPriority = $getPriority($aTags);
            $bPriority = $getPriority($bTags);

            if ($aPriority == $bPriority) {
                return 0;
            }
            return ($aPriority < $bPriority) ? -1 : 1;
        });

        return $taggedInterceptors;
    }
}
