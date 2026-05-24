<script setup>
import { ref, onMounted, watch } from "vue";

const props = defineProps({
    modelValue: { type: String, default: "" },
});
const emit = defineEmits(["update:modelValue"]);

const editorRef = ref(null);

onMounted(() => {
    if (editorRef.value) {
        editorRef.value.innerHTML = props.modelValue ?? "";
    }
});

watch(
    () => props.modelValue,
    (val) => {
        if (editorRef.value && editorRef.value.innerHTML !== (val ?? "")) {
            editorRef.value.innerHTML = val ?? "";
        }
    },
);

function onInput() {
    emit("update:modelValue", editorRef.value.innerHTML);
}

function exec(cmd, value = null) {
    editorRef.value.focus();
    document.execCommand(cmd, false, value);
    onInput();
}

function isActive(cmd) {
    try {
        return document.queryCommandState(cmd);
    } catch {
        return false;
    }
}
</script>

<template>
    <div class="border border-gray-200 rounded overflow-hidden">
        <!-- Toolbar -->
        <div
            class="flex items-center gap-0.5 border-b border-gray-200 px-2 py-1.5 bg-gray-50"
        >
            <button
                type="button"
                @click="exec('bold')"
                title="Bold"
                class="w-7 h-7 flex items-center justify-center rounded text-xs font-bold transition-colors"
                :class="
                    isActive('bold')
                        ? 'bg-orange-100 text-orange-600'
                        : 'text-slate-600 hover:bg-gray-200'
                "
            >
                B
            </button>
            <button
                type="button"
                @click="exec('italic')"
                title="Italic"
                class="w-7 h-7 flex items-center justify-center rounded text-xs italic transition-colors"
                :class="
                    isActive('italic')
                        ? 'bg-orange-100 text-orange-600'
                        : 'text-slate-600 hover:bg-gray-200'
                "
            >
                I
            </button>
            <button
                type="button"
                @click="exec('underline')"
                title="Underline"
                class="w-7 h-7 flex items-center justify-center rounded text-xs underline transition-colors"
                :class="
                    isActive('underline')
                        ? 'bg-orange-100 text-orange-600'
                        : 'text-slate-600 hover:bg-gray-200'
                "
            >
                U
            </button>

            <div class="w-px h-4 bg-gray-200 mx-1"></div>

            <button
                type="button"
                @click="exec('insertUnorderedList')"
                title="Bullet List"
                class="w-7 h-7 flex items-center justify-center rounded transition-colors"
                :class="
                    isActive('insertUnorderedList')
                        ? 'bg-orange-100 text-orange-600'
                        : 'text-slate-500 hover:bg-gray-200'
                "
            >
                <svg
                    class="w-3.5 h-3.5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"
                    />
                    <circle cx="2" cy="6" r="1" fill="currentColor" />
                    <circle cx="2" cy="12" r="1" fill="currentColor" />
                    <circle cx="2" cy="18" r="1" fill="currentColor" />
                </svg>
            </button>
            <button
                type="button"
                @click="exec('insertOrderedList')"
                title="Numbered List"
                class="w-7 h-7 flex items-center justify-center rounded transition-colors text-[10px] font-bold"
                :class="
                    isActive('insertOrderedList')
                        ? 'bg-orange-100 text-orange-600'
                        : 'text-slate-500 hover:bg-gray-200'
                "
            >
                1≡
            </button>

            <div class="w-px h-4 bg-gray-200 mx-1"></div>

            <button
                type="button"
                @click="exec('formatBlock', 'h3')"
                title="Heading"
                class="px-2 h-7 flex items-center justify-center rounded text-[10px] font-bold transition-colors text-slate-500 hover:bg-gray-200"
            >
                H3
            </button>
            <button
                type="button"
                @click="exec('formatBlock', 'p')"
                title="Paragraph"
                class="px-2 h-7 flex items-center justify-center rounded text-[10px] transition-colors text-slate-500 hover:bg-gray-200"
            >
                ¶
            </button>

            <div class="w-px h-4 bg-gray-200 mx-1"></div>

            <button
                type="button"
                @click="exec('removeFormat')"
                title="Clear Formatting"
                class="px-2 h-7 flex items-center justify-center rounded text-[10px] transition-colors text-slate-400 hover:bg-gray-200 hover:text-red-500"
            >
                ✕ Format
            </button>
        </div>

        <!-- Editable area -->
        <div
            ref="editorRef"
            contenteditable="true"
            @input="onInput"
            class="min-h-[180px] p-4 text-sm text-slate-800 leading-relaxed focus:outline-none rich-editor"
        ></div>
    </div>
</template>

<style scoped>
.rich-editor :deep(h3) {
    font-size: 1rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0.75rem 0 0.25rem;
}
.rich-editor :deep(p) {
    margin: 0.25rem 0;
}
.rich-editor :deep(ul) {
    list-style: disc;
    padding-left: 1.25rem;
    margin: 0.25rem 0;
}
.rich-editor :deep(ol) {
    list-style: decimal;
    padding-left: 1.25rem;
    margin: 0.25rem 0;
}
.rich-editor :deep(strong) {
    font-weight: 700;
}
.rich-editor :deep(em) {
    font-style: italic;
}
</style>
