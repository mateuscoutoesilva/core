# Spike SP2 — Resultado: Simulação de Upstream Merge

**Data:** 10/05/2026  
**Responsável:** mateuscoutoesilva  
**Tarefa:** FORK.02  
**Resultado:** ✅ APROVADO — esforço de merge é mínimo

---

## Contexto

O plano original (ADR-011) estimava 1 dia/mês para merge upstream, baseado na suposição de TI 3.x (monolito). Com TI 4.x, o projeto scaffold (`tastyigniter/TastyIgniter`) e a lógica de domínio (`tastyigniter/core`) são separados.

## O que analisamos

| Intervalo | Arquivos mudados no projeto | Natureza da mudança |
|-----------|----------------------------|---------------------|
| v4.2.1 → v4.2.2 | **0 arquivos** | Mudanças só no pacote `tastyigniter/core` |
| v4.0.3 → v4.2.2 | **1 arquivo** (`composer.json`, 5 linhas) | Bump de dependência Laravel 11→12 |

## Conclusão

Na arquitetura TI 4.x, as atualizações de lógica chegam via `composer update tastyigniter/core`, não via git merge do projeto. O merge do projeto scaffold é raramente necessário.

**Esforço real revisado:**
- Merge do projeto (git): ~30 min/mês (revisar compositor.json e config)
- Atualização do pacote core: ~1h/mês (`composer update` + rodar testes)
- **Total: ~1,5h/mês** (vs 1 dia/mês estimado anteriormente)

## Impacto no ADR-011

ADR-011 pode ser simplificado:
- Procedimento mensal: `composer update tastyigniter/core && php artisan test`
- Merge git do projeto: apenas quando houver release de framework (Laravel major version)
- Risco de conflito: **MUITO BAIXO** — scaffolding muda raramente

## Risco residual

Se precisarmos modificar arquivos do pacote `tastyigniter/core` diretamente (ex: adicionar `tenant_id` nos models base), precisaremos forkar também o `tastyigniter/core`. Esse caso ainda não aconteceu — nosso `App\Mtast\` namespace está no projeto.

## Decisão

✅ Prosseguir com a estratégia atual: fork do projeto + `tastyigniter/core` como dependência Composer.
