<template>
    <header class="page__header">
        <div class="header">
            <div class="content-container header__grid">
                <a href="/" class="header__logo link">
                    <ApplicationLogo />
                </a>

                <div class="header__log-in">
                    <div v-if="canLogin">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="link link--hover-uline"
                        >Личный кабинет</Link>

                        <template v-else>
                            <Link
                                :href="route('login')"
                                class="link link--hover-uline"
                            >
                                Отельерам
                            </Link>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>

<script setup lang="ts">
import {Link} from '@inertiajs/vue3';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

type TComponentProps = {
    canLogin?: boolean;
    canRegister?: boolean;
};

const props = defineProps<TComponentProps>();

</script>
