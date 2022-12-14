<?php
/**
 * AttachmentSearchResultsInterface.php
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License, which
 * is bundled with this package in the file LICENSE.txt.
 *
 * It is also available on the Internet at the following URL:
 * https://docs.auroraextensions.com/magento/extensions/2.x/simplereturns/LICENSE.txt
 *
 * @package        AuroraExtensions_SimpleReturns
 * @copyright      Copyright (C) 2019 Aurora Extensions <support@auroraextensions.com>
 * @license        MIT License
 */
declare(strict_types=1);

namespace AuroraExtensions\SimpleReturns\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface AttachmentSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return \AuroraExtensions\SimpleReturns\Api\Data\AttachmentInterface[]
     */
    public function getItems();

    /**
     * @param \AuroraExtensions\SimpleReturns\Api\Data\AttachmentInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
