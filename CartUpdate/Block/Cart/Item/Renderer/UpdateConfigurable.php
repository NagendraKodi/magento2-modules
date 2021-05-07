<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Orange\CartUpdate\Block\Cart\Item\Renderer;

use Magento\Catalog\Block\Product\ImageBuilder;
use Magento\Catalog\Helper\Product\Configuration;
use Magento\Catalog\Model\Product\Configuration\Item\ItemResolverInterface;
use Magento\Checkout\Model\Session;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Module\Manager;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Framework\Url\Helper\Data;
use Magento\Framework\View\Element\Message\InterpretationStrategyInterface;
use Magento\Framework\View\Element\Template\Context;

/**
 * Shopping cart item render block for configurable products.
 *
 * @api
 * @since 100.0.2
 */
class UpdateConfigurable extends \Magento\ConfigurableProduct\Block\Cart\Item\Renderer\Configurable
{
    /** @var Configurable * */
    public $configurable;

    /**
     * @param Context $context
     * @param Configuration $productConfig
     * @param Session $checkoutSession
     * @param ImageBuilder $imageBuilder
     * @param Data $urlHelper
     * @param ManagerInterface $messageManager
     * @param PriceCurrencyInterface $priceCurrency
     * @param Manager $moduleManager
     * @param InterpretationStrategyInterface $messageInterpretationStrategy
     * @param array $data
     * @param ItemResolverInterface|null $itemResolver
     * @param Configurable $configurable
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     * @codeCoverageIgnore
     */
    public function __construct(
        Context $context,
        Configuration $productConfig,
        Session $checkoutSession,
        ImageBuilder $imageBuilder,
        Data $urlHelper,
        ManagerInterface $messageManager,
        PriceCurrencyInterface $priceCurrency,
        Manager $moduleManager,
        InterpretationStrategyInterface $messageInterpretationStrategy,
        array $data = [],
        ItemResolverInterface $itemResolver = null,
        Configurable $configurable
    )
    {
        parent::__construct(
            $context,
            $productConfig,
            $checkoutSession,
            $imageBuilder,
            $urlHelper,
            $messageManager,
            $priceCurrency,
            $moduleManager,
            $messageInterpretationStrategy,
            $data,
            $itemResolver
        );
        $this->configurable = $configurable;
    }

    public function getConfigurableOptions($product)
    {
        $productAttributeOptions = $this->configurable->getConfigurableAttributesAsArray($product);
        return $productAttributeOptions;
    }
}
