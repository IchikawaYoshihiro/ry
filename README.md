簡易短縮URL生成システム

# URL生成
```
/api/redirects/create?url=https://google.com
/api/redirects/create_many?urls[]=https://google.com&urls[]=https://yahoo.co.jp
```

# 生成された短縮URLでアクセス

/abcd

# Development
## API
Lumen

```
cd api
composer run serve
```

## frontend
React+TypeScript

```
cd frontend
yarn start
```