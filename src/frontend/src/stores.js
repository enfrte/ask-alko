import { writable } from 'svelte/store';

export const selectColumn = writable(); // result of column query
export const columnQuery = writable(); // generated column query
