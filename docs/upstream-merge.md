# Procedimento de Upstream Merge

**Janela fixa:** 1ª sexta-feira útil de cada mês  
**Base upstream:** `https://github.com/tastyigniter/TastyIgniter.git`  
**Tag de referência inicial:** `upstream/v4.2.2`

---

## Nota sobre a arquitetura TI 4.x

O TastyIgniter 4.x separa a lógica em duas camadas:

- **`mateuscoutoesilva/core`** (este repo) — o projeto Laravel: rotas, controllers Inertia, views Vue, migrations extras, configurações
- **`tastyigniter/core`** (pacote Composer) — o core TI: models base, migrations base, extensions

Para o **projeto** (este repo), o upstream merge segue este documento.  
Para o **pacote Composer**, a atualização é via `composer update tastyigniter/core` (ver seção 3).

---

## 1. Atualizar o projeto (este repo)

```bash
# 1. Buscar mudanças do upstream
git fetch upstream

# 2. Ver o que mudou desde a nossa tag base
git log upstream/v4.2.2..upstream/4.x --oneline

# 3. Criar branch de merge
git checkout -b merge/upstream-YYYY-MM

# 4. Cherry-pick fixes de segurança relevantes (ou merge seletivo)
git cherry-pick <commit-hash>

# 5. Resolver conflitos, rodar testes
php artisan test
npm run test

# 6. Atualizar a tag de referência
git tag -f upstream/vX.Y.Z upstream/4.x
git push origin upstream/vX.Y.Z

# 7. Abrir PR para main
```

---

## 2. Registrar mudanças no CHANGES.md

Se algum arquivo fora de `app/Mtast/` foi modificado, atualizar `CHANGES.md` com:
- Arquivo modificado
- Motivo
- Link do PR
- Teste que cobre

---

## 3. Atualizar o pacote `tastyigniter/core` (Composer)

```bash
# Ver o changelog do pacote
# https://github.com/tastyigniter/core/releases

# Atualizar
composer update tastyigniter/core --no-interaction

# Testar
php artisan test

# Commitar o composer.lock atualizado
git add composer.lock
git commit -m "chore: update tastyigniter/core to vX.Y.Z"
```

---

## 4. Esforço esperado

- Merge do projeto: ~2h/mês (patches pequenos)
- Atualização do pacote: ~30min/mês (só `composer update` + testes)
- Release maior do TI (ex: 4.x → 5.0): sprint dedicada de 5 dias

---

## Histórico de merges

| Data | Versão upstream | Responsável | Status |
|------|----------------|-------------|--------|
| — | v4.2.2 | mateuscoutoesilva | base inicial |
