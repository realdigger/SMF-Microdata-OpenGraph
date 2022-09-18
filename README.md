[![GitHub release](https://img.shields.io/github/release/realdigger/SMF-Microdata-OpenGraph.svg)](https://github.com/realdigger/SMF-Microdata-OpenGraph/releases)
[![SMF](https://img.shields.io/badge/SMF-2.0-blue.svg?style==flat)](https://simplemachines.org)
[![SMF](https://img.shields.io/badge/SMF-2.1-blue.svg?style==flat)](https://simplemachines.org)
[![license](https://img.shields.io/github/license/realdigger/SMF-Microdata-OpenGraph.svg)](https://github.com/realdigger/SMF-Microdata-OpenGraph/blob/master/LICENSE.txt)

# SMF Microdata mod
* **Author:** digger [https://mysmf.net](https://mysmf.net)
* **License:** The MIT License (MIT) https://opensource.org/licenses/MIT
* **Compatible with:** SMF 2.0, SMF 2.1
* **Languages:** English, Russian

## Installation  
Download and install latest release tar.gz file from [releases page](https://github.com/realdigger/SMF-Microdata-OpenGraph/releases).

## Description
This mod adds [microdata breadcrumb schema](http://www.data-vocabulary.org/Breadcrumb) for SMF linktree, some [Open Graph tags](http://ogp.me) and [TwitterCards](https://dev.twitter.com/cards/overview).

## Установка    
Загрузите и установите файл tar.gz актуальной версии со [страницы загрузок](https://github.com/realdigger/SMF-Microdata-OpenGraph/releases).

## Описание
Добавляет различные виды семантической микроразметки к страницам SMF.  
* Разметка [хлебных крошек](https://support.google.com/webmasters/answer/185417?hl=ru) для Google.
* Разметка [OpenGraph](http://ogp.me) для первого сообщения на странице (поддерживается FaceBook, ВКонтакте и прочие).
 * Разметка [TwitterCards](https://dev.twitter.com/cards/overview) для первого сообщения на странице (поддерживается Twitter).

### Картинка статьи
Берется или заданная в настройках мода по умолчанию для всего сайта или полученная из первого графического вложения или первого обнаруженного тэга IMG в теле первого сообщения на странице. 
По умолчанию рекомендуется задать изображение с пропорциями близкими к квадрату и размером не менее 200x200px.

### Подтверждение твиттер-карточек
После установки и настройки мода, идем в валидатор по ссылке из настроек мода, выбираем тип карточки summary, переходим на вкладку «Validate & Apply» и там вставляем ссылку на страницу какой-нибудь темы с форума доступной гостям. Убедитесь, что разметка верная, домен пока будет «not approved».

Нажмите Request Approval и увидите уже заполненную форму. Можно что-то подредактировать по желанию, заполнить нужно только описание сайта в поле «Website Description». Затем, нажмите «Request Approval», увидите сообщение «Thanks for applying to be part of Twitter's cards service. We'll review your request as soon as possible. Expect a few weeks for turn-around time. You will receive an email when your request has been reviewed».

В течение нескольких минут на почту придет письмо об успешном одобрении указанного типа карточек для вашего аккаунта. 

Ссылки с вашего форума, которые были опубликованы в Твиттере до установки мода, через некоторое время переиндексируются и получат карточки.

![microdata1](https://user-images.githubusercontent.com/1187218/28817240-a4674b90-76b8-11e7-82e7-8429b1026e33.png)  
Оригинальный топик

![microdata2](https://user-images.githubusercontent.com/1187218/28817243-a493c198-76b8-11e7-8e2a-666696ce24d5.png)  
Твиттер-карточка

![microdata3](https://user-images.githubusercontent.com/1187218/28817241-a492507e-76b8-11e7-8eb0-d458380b27dc.png)  
Ссылка во Вконтакте

![microdata4](https://user-images.githubusercontent.com/1187218/28817242-a493483a-76b8-11e7-8928-4d38de89a0ae.png)  
Хлебные крошки

![microdata5](https://user-images.githubusercontent.com/1187218/28817244-a4950292-76b8-11e7-90e5-0a96c93b392e.png)  
Настройки мода
