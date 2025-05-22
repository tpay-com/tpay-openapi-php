<?php

namespace Tpay\OpenApi\Utilities;

use Psr\Cache\CacheItemPoolInterface;
use Psr\SimpleCache\CacheInterface;

class Cache
{
    private $cacheItemPool;
    private $cache;

    public function __construct(?CacheItemPoolInterface $cacheItemPool = null, ?CacheInterface $cache = null)
    {
        $this->cacheItemPool = $cacheItemPool;
        $this->cache = $cache;

        if (null === $cacheItemPool && null === $cache) {
            throw new TpayException('Both of cache implementation cannot be null!');
        }
    }

    public function set($key, $value, $ttl)
    {
        if ($this->cache) {
            $this->cache->set($key, $value, $ttl);

            return;
        }

        if ($this->cacheItemPool) {
            $item = $this->cacheItemPool->getItem($key);
            $item->set($value);
            $item->expiresAfter(7100);
            $this->cacheItemPool->save($item);
        }
    }

    public function get($key)
    {
        if ($this->cache) {
            return $this->cache->get($key, null);
        }

        if ($this->cacheItemPool) {
            $cacheItem = $this->cacheItemPool->getItem($key);
            if ($cacheItem->isHit()) {
                return $cacheItem->get();
            }
        }
    }

    public function delete($key)
    {
        if ($this->cache) {
            $this->cache->delete($key);
        }
        if ($this->cacheItemPool) {
            $this->cacheItemPool->deleteItem($key);
        }
    }
}
