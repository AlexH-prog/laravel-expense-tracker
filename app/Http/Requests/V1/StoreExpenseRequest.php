<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
        //return false;
    }

    protected function prepareForValidation(): void
    {
        //dd($this->request);
        /*if ($this->request->get('status') == 'done') {
            $currentDataTime = date('Y-m-d H:i:s');
            $this->merge([
                'completed_at' => $currentDataTime
            ]);
        }*/
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'date' => 'required|date',
            'comment' => 'nullable|string|max:255',
            'items' => 'required|array',
            /*'items[category]' => 'required|string|max:255',
            'items[quantity]' => 'required|integer|min:1',
            'items[price]' => 'required|numeric|min:0',*/
            /*'items.*.category' => 'required|string|max:255',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',*/
        ];
    }
}
